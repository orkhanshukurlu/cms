<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Category;
use App\Models\Portfolio;
use App\Services\Filer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:portfolio-index'], ['only' => ['index']]);
        $this->middleware(['permission:portfolio-index',  'permission:portfolio-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:portfolio-index',  'permission:portfolio-show'],    ['only' => ['show']]);
        $this->middleware(['permission:portfolio-index',  'permission:portfolio-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:portfolio-index',  'permission:portfolio-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.portfolio.index');
    }

    public function create(): View|RedirectResponse
    {
        try {
            $categories = Category::active()->get(['id', 'name']);
            return view('backend.portfolio.create', compact('categories'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function store(PortfolioRequest $request, Filer $filer): RedirectResponse
    {
        try {
            $image = $filer->upload('portfolio', $request->image);
            $data  = $request->safe()->merge(['slug' => Str::slug($request->title), 'image' => $image]);

            DB::transaction(function () use ($data, $filer, $request) {
                $portfolio = Portfolio::create($data->all());
                $images    = $filer->multiUpload('portfolio', $request->images);
                $portfolio->photos()->createMany(hasMany($images));
            });

            return to_route('backend.portfolio.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            if (isset($image)) {
                $filer->delete('portfolio', $image);
            }

            if (isset($images)) {
                $filer->delete('portfolio', $images);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.portfolio.index')->withError(__('messages.error.create'));
        }
    }

    public function show(Portfolio $portfolio): View|RedirectResponse
    {
        try {
            return view('backend.portfolio.show', compact('portfolio'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function edit(Portfolio $portfolio): View|RedirectResponse
    {
        try {
            $categories = Category::active()->get(['id', 'name']);
            return view('backend.portfolio.edit', compact('portfolio', 'categories'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio, Filer $filer): RedirectResponse
    {
        try {
            if ($request->hasFile('image')) {
                $filer->delete('portfolio', $portfolio->image);
                $image = $filer->upload('portfolio', $request->image);
                $data  = $request->safe()->merge(['slug' => Str::slug($request->title), 'image' => $image]);
            }

            else {
                $data = $request->safe()->merge(['slug' => Str::slug($request->title)]);
            }

            DB::transaction(function () use ($data, $request, $portfolio, $filer) {
                $portfolio->updateOrder($portfolio->order, $request->order);
                $portfolio->update($data->all());

                if ($request->filled('delete_images')) {
                    $photos      = $request->delete_images;
                    $photoIds    = $portfolio->photos()->whereIn('id', $photos)->pluck('id')->toArray();
                    $photoImages = $portfolio->photos()->whereIn('id', $photos)->pluck('image')->toArray();
                    $filer->multiDelete('portfolio', $photoImages);
                    $portfolio->photos()->whereIn('id', $photoIds)->delete();
                }

                if ($request->hasFile('images')) {
                    $images = $filer->multiUpload('portfolio', $request->images);
                    $portfolio->photos()->createMany(hasMany($images));
                }
            });

            return to_route('backend.portfolio.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            if ($request->hasFile('image') && isset($image)) {
                $filer->delete('portfolio', $image);
            }

            if ($request->hasFile('images') && isset($images)) {
                $filer->delete('portfolio', $images);
            }

            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.portfolio.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Portfolio $portfolio, Filer $filer)
    {
        try {
            $photos = $portfolio->photos->pluck('image')->toArray();

            DB::transaction(function () use ($portfolio) {
                $portfolio->delete();
                $portfolio->photos()->delete();
            });

            $filer->delete('portfolio', $portfolio->image);
            $filer->multiDelete('portfolio', $photos);
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
