<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $this->authorize('photo.view');

        return  view('admin.photo.index');
    }

    public function data(){
        $this->authorize('photo.view');

        $photos = Photo::query()
            ->when(request()->position, function ($q, $position){
                $q->wherePosition($position);
            })
            ->when(request()->search, function ($q, $key){
                $q->where('name','like',"%$key%")->orWhere('position','like',"%$key%")->orWhere('image','like',"%$key%");
            })
            ->when(request()->author,function ($q, $author){
                return $q->whereAdminId($author);
            })

            ->when(request()->public, function ($q, $public){
                return $q->wherePublic($public);
            });

        return datatables()->of($photos)

            ->editColumn('thumbnail', function ($photo){
                return $photo->thumb;
            })
            ->editColumn('created_at', function ($photo){
                return $photo->created_at->diffForHumans();
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
        $this->authorize('photo.create');

        return  view('admin.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('photo.create');

        $images = $request->images;

        if(!$images)
            return flash(__('lang.select_image'),3);

        for ($i=0; $i < count($images); $i++){
            $photo = new Photo();
            $photo->forceFill($request->data);
            $photo->name = $request->name[$i];
            $photo->path = $request->path[$i];
            $photo->image = $request->images[$i];
            $photo->save();
        }

      return flash(__('lang.flash_create'));
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
    public function edit(Photo $photo)
    {
        $this->authorize('photo.edit');

        return  view('admin.photo.edit',compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->authorize('photo.edit');

        $photo->forceFill($request->data);
        $photo->admin_edit = auth()->id();
        $photo->save();

        return flash(__('lang.flash_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $this->authorize('photo.destroy');

        $photo->delete();
        return flash(__('lang.flash_destroy'));
    }
}
