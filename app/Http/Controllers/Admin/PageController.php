<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{
    public function index()
    {
        $this->authorize('blog.view');

        $admins = Admin::select('id','name','email')->when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.page.index', compact('admins'));
    }

    public function create(){
        $this->authorize('blog.create');

        $tags = Tag::ofType(TagType::post)->get();

        return view('admin.page.create', compact('tags'));
    }

    public function edit(Post $page){

        $this->authorize('blog.edit');

        $translations = $page->translations->load('language');
        $tags = Tag::ofType(TagType::post)->get();

        return view('admin.page.edit', compact('page','translations','tags'));
    }
}
