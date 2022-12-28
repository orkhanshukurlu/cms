<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\Filer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:brands-index'], ['only' => ['index']]);
        $this->middleware(['permission:brands-index',  'permission:brands-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:brands-index',  'permission:brands-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:brands-index',  'permission:brands-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.brands.index');
    }

    public function create(): View
    {
        return view('backend.brands.create');
    }

    public function store(BrandRequest $request, Filer $filer): RedirectResponse
    {
        try {
            $image = $filer->upload('brands', $request->image);
            $data  = $request->safe()->merge(['image' => $image]);
            Brand::create($data->all());
            return to_route('backend.brands.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            if (isset($image)) {
                $filer->delete('brands', $image);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.brands.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(Brand $brand): View|RedirectResponse
    {
        try {
            return view('backend.brands.edit', compact('brand'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(BrandRequest $request, Brand $brand, Filer $filer): RedirectResponse
    {
        try {
            if ($request->hasFile('image')) {
                $filer->delete('brands', $brand->image);
                $image = $filer->upload('brands', $request->image);
                $data  = $request->safe()->merge(['image' => $image])->all();
            }

            else {
                $data = $request->validated();
            }

            $brand->update($data);
            return to_route('backend.brands.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            if ($request->hasFile('image') && isset($image)) {
                $filer->delete('brands', $image);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.brands.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Brand $brand, Filer $filer): Response
    {
        try {
            $brand->delete();
            $filer->delete('brands', $brand->image);
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
