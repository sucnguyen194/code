<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('product.view');

        return view('admin.product.filter.index');
    }

    public function data(){
        $attributes = Filter::query()->with('translation',function($q){
            $q->select('name','filter_id');
        });

        return datatables()->of($attributes)
            ->editColumn('name', function ($attribute){
                return $attribute->name;
            })
            ->order(function($q){
                $q->orderBy(\request()->input('sort','created_at'),\request()->input('order','desc'));
            })->make();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('product.create');

        $categories = Filter::with('translation')->whereParentId(0)->get();

        return view('admin.product.filter.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('product.create');

        $filter = new Filter();
        $filter->forceFill($request->data);
        $filter->save();
        $filter->translations()->createMany($request->translation);

        return flash(__('_the_record_is_added_successfully'));
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
    public function edit(Filter $filter)
    {
        $this->authorize('product.edit');

        $categories = Filter::with('translation')->where('id','!=',$filter->id)->whereParentId(0)->get();

        $translations = $filter->translations->load('language');

        return view('admin.product.filter.edit',compact('categories','filter','translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        $this->authorize('product.edit');

        $filter->forceFill($request->data);
        $filter->save();

        //translations
        foreach ($request->translation as $translation):
            $filter->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        $this->authorize('product.destroy');
        $filter->delete();
        return flash(__('_the_record_is_deleted_successfully'));
    }
}
