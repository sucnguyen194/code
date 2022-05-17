<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('recruitment.view');

        $categories = Category::query()->with('translation',function($q){
            $q->select('id','name','category_id');
        })->whereType(CategoryType::recruitment)->public()->latest()->get();

        $authors = Controller::getAllAdmins();

        return  view('admin.recruitment.index' ,compact('authors','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('recruitment.create');

        $categories = Category::ofType(CategoryType::recruitment)->get();

        $tags = Tag::ofType(TagType::post)->get();

        return view('admin.recruitment.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $recruitment)
    {
        $this->authorize('recruitment.edit');

        $categories = Category::ofType(CategoryType::recruitment)->get();

        $translations = $recruitment->translations->load('language');

        $tags = Tag::ofType(TagType::post)->get();

        return  view('admin.recruitment.edit', compact('recruitment','categories','translations','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
