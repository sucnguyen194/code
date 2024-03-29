<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('product.view');

        return view('admin.product.attribute.index');
    }

    public function data(){
        $attributes = Attribute::query()->with('translation',function($q){
            $q->select('name','attribute_id');
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

        $categories = Attribute::with('translation')->whereCategoryId(0)->get();

        return view('admin.product.attribute.create',compact('categories'));
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

        $attribute = new Attribute();
        $attribute->forceFill($request->data);
        $attribute->save();
        $attribute->translations()->createMany($request->translation);

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
    public function edit(Attribute $attribute)
    {
        $this->authorize('product.edit');

        $categories = Attribute::with('translation')->where('id','!=',$attribute->id)->whereCategoryId(0)->get();

        $translations = $attribute->translations->load('language');

        return view('admin.product.attribute.edit',compact('categories','attribute','translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $this->authorize('product.edit');

        $attribute->forceFill($request->data);
        $attribute->save();

        //translations
        foreach ($request->translation as $translation):
            $attribute->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $this->authorize('product.destroy');
        $attribute->delete();
        return flash(__('_the_record_is_deleted_successfully'));
    }

    public function render($id){
        $this->authorize('product.view');

        session()->forget('attributes');
        $id = explode(',', $id);
        $id = array_unique($id);
        session()->put('attributes', $id);

        $attributes = Attribute::whereIn('id',$id)->oldest('id')->get();

        return response()->json($attributes);
    }
}
