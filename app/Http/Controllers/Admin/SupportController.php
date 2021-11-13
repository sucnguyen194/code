<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('support.view');

        $admins = Admin::when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.support.index',compact('admins'));
    }

    public function data(){
        $this->authorize('support.view');
        $supports = Support::query()->with(['admin', 'translation' => function($q){
            $q->select('name','support_id');
        }])->whereHas('translation')
            ->when(\request()->type,function($q, $type){
                return $q->whereType($type);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%');
                });
            })
            ->when(\request()->author,function($q,$admin){
                return $q->whereAdminId($admin);
            })
            ->when(\request()->public,function($q, $public){
                return $q->wherePublic($public);
            })
            ->when(\request()->status,function($q, $status){
                return $q->whereStatus($status);
            })->withTranslation();

        return datatables()->of($supports)
            ->editColumn('name',function ($support){
                return $support->translation->name;
            })
            ->editColumn('created_at',function ($support){
                return $support->created_at->diffForHumans();
            })
            ->order(function ($q){
            $q->orderBy(request()->input('sort','created_at'), request()->input('order','desc'));
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('support.create');

        return view('admin.support.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('support.create');

        $support = new Support();
        $support->forceFill($request->data);
        $support->save();

        $support->translations()->createMany($request->translation);

        return flash('Thêm mới thành công!');
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
    public function edit(Support $support)
    {
        $this->authorize('support.edit');
        $translations = $support->translations->load('language');

        return view('admin.support.edit',compact('support','translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        $this->authorize('support.edit');

        $support->forceFill($request->data);
        $support->admin_edit = auth()->id();
        $support->save();

        //translations
        foreach ($request->translation as $translation):
            $support->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        return flash('Cập nhật thành công!', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support  $support)
    {
        $this->authorize('support.destroy');

        $support->delete();

        return flash('Xóa bản ghi thành công!');
    }

}
