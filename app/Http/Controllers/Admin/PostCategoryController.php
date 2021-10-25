<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PostCategoryController extends Controller
{
    public function index(){
        $this->authorize('blog.view');

        return view('admin.post.category.index');
    }

    public function create(){
        $this->authorize('blog.create');

        $categories = Category::whereType(CategoryType::post)->withTranslation()->latest()->get();
        return view('admin.post.category.create',compact('categories'));
    }

    public function edit(Category $category){
        $this->authorize('blog.edit');

        $categories = Category::whereType($category->type)->whereNotIn('id',[$category->id])->withTranslation()->public()->latest()->get();

        $translations = $category->translations->load('language');

        return view('admin.post.category.edit',compact('categories','category','translations'));
    }

}
