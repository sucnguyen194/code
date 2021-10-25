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

        $categories = Category::query()->with('translation', function ($q){
            $q->select('name','slug','id','category_id');
        })->whereType(CategoryType::post)->latest()->get();
        return view('admin.post.category.create',compact('categories'));
    }

    public function edit(Category $category){
        $this->authorize('blog.edit');

        $categories = Category::query()->with('translation', function ($q){
            $q->select('id','name','category_id');
        })->whereType($category->type)->whereNotIn('id',[$category->id])->public()->latest()->get();

        $translations = $category->translations->load('language');

        return view('admin.post.category.edit',compact('categories','category','translations'));
    }

}
