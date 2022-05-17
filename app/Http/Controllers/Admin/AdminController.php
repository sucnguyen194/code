<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.index');
    }


    public function data(){

        $admins = Controller::getAllAdmins();

        $admins->with('roles')->when(\request('search'),function ($q, $search){
            return $q->whereLike(['id','name','email'], $search);
        });

        return datatables()->of($admins)
            ->editColumn('roles', function($admin){
                return $admin->roles->pluck('name')->toArray();
            })
            ->editColumn('created_at', function($admin){
                return $admin->created_at->diffForHumans();
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
       $this->authorize('admin.create');

        $roles = Role::get();
        return view('admin.admin.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin.create');

        $request->validate([
            'data.name' => 'required',
            'data.email' => 'required|unique:admins,email',
        ]);

        $admin = new Admin();
        $admin->forceFill($request->data);
        $admin->password = bcrypt($request->password);
        $admin->save();

        if ($request->roles){
            $admin->syncRoles($request->roles);
        }

        return  flash(__('_the_record_is_added_successfully'));
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
    public function edit(Admin $admin)
    {
        $this->authorize('admin.edit');

        if($admin->id == 1 && auth()->id() > 1)
            return flash(___('_error'),0);

        $roles = Role::get();

        return view('admin.admin.edit',compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->authorize('admin.edit');

        $request->validate([
            'data.name' => 'required',
            'data.email' => 'required|unique:admins,email,'.$admin->id,
        ]);

        if($admin->id == 1 && auth()->id() > 1)
            return flash(___('_error'),0);

        $admin->forceFill($request->data);

        if($request->has('password'))
            $admin->password = bcrypt($request->password);

        $admin->save();

        if ($request->roles){
            $admin->syncRoles($request->roles);
        }

        return flash(__('_the_record_is_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('admin.destroy');

        if ($admin->id == auth()->id() || ($admin->id == 1 && auth()->id() > 1) ){
            return flash(__('_error'), 0);
        }

        $admin->delete();
        return flash(__('_the_record_is_deleted_successfully'));
    }
}
