<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SystemType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Lang;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class PageController extends Controller
{
    public function index()
    {
        if(auth()->id() > 1) $this->authorize('blog.view');

        $admins = Admin::when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.page.index', compact('admins'));
    }

    public function create(){
        if(auth()->id() > 1) $this->authorize('blog.create');

        return view('admin.page.create');
    }

    public function edit(Post $page){

        if(auth()->id() > 1) $this->authorize('blog.edit');

        $translations = $page->translations->load('language');

        return view('admin.page.edit', compact('page','translations'));
    }
}
