<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('permission.view');

        return view('admin.permissions.index');
    }

    public function data()
    {
        $permissions = Permission::query()->latest()->get();

        return datatables()->of($permissions)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('permission.create');

        $permissions = Permission::whereParentId(0)->get();
        return view('admin.permissions.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('permission.create');

        $request->validate([
            'title' => 'required',
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create($request->all());

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
    public function edit(Permission $permission)
    {
        $this->authorize('permission.edit');

        $permissions = Permission::whereParentId(0)->get();
        return view('admin.permissions.edit',compact('permission','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('permission.edit');

        $request->validate([
            'title' => 'required',
            'name' => 'required|unique:permissions,email,'.$permission->id,
        ]);

        $permission->update($request->all());

        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('permission.destroy');

        Permission::whereParentId($permission->id)->delete();

        $permission->delete();

        return flash(__('_the_record_is_deleted_successfully'));
    }
}
