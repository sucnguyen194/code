<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->id() > 1) $this->authorize('role.view');

        return view('admin.role.index');
    }

    public function data(){
        $roles = Role::query()->when(auth()->id() > 1, function ($q){
            return $q->where('id','>',1);
        })->when(\request()->search,function ($q,$search){
            return $q->where('name','like',"%{$search}%");
        });

        return datatables()->of($roles)
            ->editColumn('permission',function ($role){
                return $role->permissions->pluck('title')->toArray();
            })
            ->order(function($q){
                $q->orderBy(\request()->input('sort','created_at'),\request()->input('order','desc'));
            })->make('true');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->id() > 1) $this->authorize('role.create');
        $permissions = Permission::get();

        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->id() > 1) $this->authorize('role.create');

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);
        $role->syncPermissions($request->permissions);

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
    public function edit(Role $role)
    {
        if(auth()->id() > 1) $this->authorize('role.edit');
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Role $role)
    {
        if(auth()->id() > 1) $this->authorize('role.edit');

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return flash(__('lang.flash_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if(auth()->id() > 1) $this->authorize('role.destroy');

        if ($role->users()->count() > 0)
            return flash(__('_error'),0);

        $role->delete();
        return flash(__('lang.flash_destroy'));
    }
}
