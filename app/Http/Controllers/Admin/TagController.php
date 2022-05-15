<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('tag.view');

        return view('admin.tag.index');
    }

    public function data(){
        $this->authorize('tag.view');

        $tags = Tag::query()->when(request()->type, function($q, $type){
           return $q->whereType($type);
        })->with('translation', function($q){
            $q->select('tag_id','name','slug');
        });

        return datatables()->of($tags)
            ->editColumn('name', function ($tag){
                return $tag->name;
            })

            ->editColumn('slug', function ($tag){
                return $tag->slug;
            })
            ->editColumn('created_at', function ($tag){
                return $tag->created_at->diffForHumans();
            })

            ->order(function ($query){
                $query->orderBy(request()->input('sort','created_at'), request()->input('order','desc'));
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('tag.create');

        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationRequest $request)
    {
        $this->authorize('tag.create');

        $request->validate([
            'data.type' => 'required',
        ]);

        $tag = new Tag();
        $tag->forceFill($request->data);
        $tag->save();

        $tag->translations()->createMany($request->translation);

        return flash(__('_the_record_is_added_successfully'));
    }

    public function ajax_create(){
        $this->authorize('tag.create');

        return view('admin.tag.ajax_create');
    }

    public function add(StoreTranslationRequest $request){

        $this->authorize('tag.create');

        $request->validate([
            'data.type' => 'required',
        ]);

        $tag = new Tag();
        $tag->forceFill($request->data);
        $tag->save();

        $tag->translations()->createMany($request->translation);

        if($tag){
            $tag->load(['translation' => function($q){
                $q->select('id','tag_id','name');
            }]);

            return  response()->json($tag);
        }

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
    public function edit(Tag $tag)
    {
        $this->authorize('tag.edit');

        $translations = $tag->translations->load('language');

        return view('admin.tag.edit', compact('tag','translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationRequest $request, Tag $tag)
    {
        $this->authorize('tag.edit');

        $request->validate([
            'data.type' => 'required',
        ]);

        $tag->forceFill($request->data);
        $tag->save();

        //translations
        foreach ($request->translation as $translation):
            $tag->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        return  flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('tag.destroy');

        $tag->delete();
        return  flash(__('_the_record_is_deleted_successfully'));
    }
}
