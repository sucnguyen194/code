<?php

namespace App\Http\Controllers\Admin;
use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('product.view');

        return view('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('product.create');
        $categories = Category::ofType(CategoryType::product)->get();

        return view('admin.product.category.create',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){

        $this->authorize('product.edit');
        $categories = Category::ofType($category->type)->whereNotIn('id',[$category->id])->get();
        $translations = $category->translations->load('language');

        return view('admin.product.category.edit',compact('categories','category','translations'));
    }
}
