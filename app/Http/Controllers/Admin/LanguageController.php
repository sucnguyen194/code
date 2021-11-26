<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('setting.language');

        return view('admin.language.index');
    }


    public function data(){
        $this->authorize('setting.language');
        $langs = Language::query()->when(\request()->search,function($q, $search){
            return $q->where('name','like',"%{$search}%")->orWhere('id',$search);
        });

        return datatables()->of($langs)

            ->order(function ($q){
                $q->orderby(\request()->input('sort','created_at'), \request()->input('order','desc'));
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('setting.language');

        $languages = Language::latest()->get();

        return view('admin.language.create',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('setting.language');
        $request->validate([
            'name' => 'required|string|unique:languages',
            'value' => 'required|string|max:2|unique:languages',
        ]);
        Language::create([
            'name' => $request->name,
            'value' => $request->value,
            'image' => $request->image,
        ]);
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
    public function edit(Language $language)
    {
        $this->authorize('setting.language');

        $languages = Language::latest()->get();

        return view('admin.language.edit',compact('languages','language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $this->authorize('setting.language');

        $request->validate([
            'name' => 'required|string|unique:languages,name,'.$language->id,
            'value' => 'required|string|max:2|unique:languages,value,'.$language->id,
        ]);
        $language->update([
            'name' => $request->name,
            'value' => $request->value,
            'image' => $request->image
        ]);
        return flash(__('lang.flash_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $this->authorize('setting.language');

        if(Language::count() == 1)
            return flash(__('lang.error'), 3 );

        $language->delete();
        return flash(__('lang.flash_update'));

    }

    public function active($id){
        $this->authorize('setting.language');

        $language = Language::findOrFail($id);
        $languages = Language::whereNotIn('id',[$id])->get();
        foreach ($languages as $item){
            $item->update(['status' => ActiveDisable::disable]);
        }
        $language->update(['status' => ActiveDisable::active]);

        session()->put('lang', $language->value);
        App::setLocale($language->value);

        return flash(__('lang.flash_update'));
    }

    public function change($lang){
        $this->authorize('setting.language');
        $language = Language::whereValue($lang)->first();

        if(!$language)
            return flash(__('lang.error'), 0);

        $languages = Language::whereNotIn('value',[$lang])->get();
        foreach ($languages as $item){
            $item->update(['status' => ActiveDisable::disable]);
        }
        $language->update(['status' => ActiveDisable::active]);
        session()->put('lang',$lang);
        App::setLocale($lang);

        return flash(__('lang.flash_update'));
    }
}
