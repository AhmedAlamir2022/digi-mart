<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryStoreRequest;
use App\Http\Requests\Admin\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

use function Flasher\Notyf\Prime\notyf;

class SubCategoryController extends Controller implements HasMiddleware
{
    static function Middleware() : array
    {
        return [
            new Middleware('permission:show all sub-categories', only: ['index']),
            new Middleware('permission:add new sub-category', only: ['create', 'store']),
            new Middleware('permission:edit sub-category', only: ['edit', 'update']),
            new Middleware('permission:delete sub-category', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->paginate(10);
        return view('admin.category.sub-category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryStoreRequest $request) : RedirectResponse
    {
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->category_id = $request->category;
        $subCategory->save();

        notyf()->success('Sub Category Created Successfully');
        return to_route('admin.sub-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.category.sub-category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory) : RedirectResponse
    {
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->save();

        notyf()->info('Sub Category Updated Successfully');
        return to_route('admin.sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();

            notyf()->info('Sub Category deleted successfully.');
            return response()->json(['status' => 'success', 'message' => __('Delete successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
