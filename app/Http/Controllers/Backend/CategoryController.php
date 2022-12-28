<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\UserLog;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:categories-index'], ['only' => ['index']]);
        $this->middleware(['permission:categories-index',  'permission:categories-create'],  ['only' => ['create', 'store']]);
        $this->middleware(['permission:categories-index',  'permission:categories-edit'],    ['only' => ['edit', 'update']]);
        $this->middleware(['permission:categories-index',  'permission:categories-destroy'], ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('backend.categories.index');
    }

    public function create(): View
    {
        return view('backend.categories.create');
    }

    public function store(CategoryRequest $request, UserLog $userLog): RedirectResponse
    {
        try {
            $category = Category::create($request->validated());
            $userLog->save('brands', $category->id);
            return to_route('backend.categories.index')->withSuccess(__('messages.success.create'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.categories.index')->withError(__('messages.error.create'));
        }
    }

    public function edit(Category $category): View|RedirectResponse
    {
        try {
            return view('backend.categories.edit', compact('category'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.page'));
        }
    }

    public function update(CategoryRequest $request, Category $category, UserLog $userLog): RedirectResponse
    {
        try {
            $userLog->save(Category::class, $category->id, [$request, $category]);
            $category->update($request->validated());
            return to_route('backend.categories.index')->withSuccess(__('messages.success.update'));
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return to_route('backend.categories.index')->withError(__('messages.error.update'));
        }
    }

    public function destroy(Category $category): Response
    {
        try {
            if ($category->portfolio()->exists()) {
                return response(['warning' => true]);
            }

            $category->delete();
            return response(['success' => true]);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return response(['error' => true]);
        }
    }
}
