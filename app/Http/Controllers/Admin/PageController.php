<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;

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

        return view('admin.page.create');
    }

    public function edit(Post $page){

        $this->authorize('blog.edit');

        $translations = $page->translations->load('language');

        return view('admin.page.edit', compact('page','translations'));
    }
}
