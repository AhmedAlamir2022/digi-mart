<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CategoryController extends Controller implements HasMiddleware
{
    static function Middleware() : array
    {
        return [
            new Middleware('permission:show all categories', only: ['index']),
            new Middleware('permission:add new category', only: ['create', 'store']),
            new Middleware('permission:edit category', only: ['edit', 'update']),
            new Middleware('permission:delete category', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->file_types = explode(',', $request->file_types);
        $category->show_at_nav = $request->show_at_nav;
        $category->show_at_featured = $request->show_at_featured;
        $category->save();

        notyf()->success('Category created successfully');
        return to_route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->file_types = explode(',', $request->file_types);
        $category->show_at_nav = $request->show_at_nav;
        $category->show_at_featured = $request->show_at_featured;
        $category->save();

        notyf()->info('Category updated successfully');
        return to_route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if($category->subCategories()->exists()) {
                return response()->json(['status' => 'error', 'message' => __('This category has sub categories and can not be deleted')], 402);
            }

            $category->delete();

            notyf()->info('Category deleted successfully.');
            return response()->json(['status' => 'success', 'message' => __('Delete successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
