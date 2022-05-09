<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('map.view');

        return view('admin.map.index');
    }

    public function data(){

        $maps = Map::query()->with('admin');

        return datatables()->of($maps)
            ->editColumn('created_at', function ($map){
                return $map->created_at->diffForHumans();
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
        $this->authorize('map.create');

        return view('admin.map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('map.create');

        Validator::make($request->data,[
           'name' => 'string|required',
        ])->validate();

        $map = new Map();
        $map->forceFill($request->data);
        $map->admin_id = auth()->id();
        $map->save();

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
    public function edit(Map  $map)
    {
        $this->authorize('map.edit');

        return view('admin.map.edit',compact('map'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        Validator::make($request->data,[
            'name' => 'string|required',
        ])->validate();

        $map->forceFill($request->data);
        $map->wifi = $request->wifi ? ActiveDisable::active : ActiveDisable::disable;
        $map->checkout = $request->checkout ? ActiveDisable::active : ActiveDisable::disable;

        $map->save();
        return flash(__('lang.flash_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map  $map)
    {
        $this->authorize('map.destroy');

        $map->delete();

        return flash(__('lang.flash_destroy'));
    }
}
