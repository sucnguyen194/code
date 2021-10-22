<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user.view');

        return view('admin.user.index');
    }

    public function data(){
        $users = User::query()->when(request()->search,function($q, $search){
           return $q->where('name','like',"%$search%")->orWhere('id',$search)->orWhere('email','like',"%$search%");
        });

        return datatables()->of($users)
            ->editColumn('created_at',function ($user){
                return $user->created_at->diffForHumans();
            })
            ->order(function($q){
            $q->orderBy(request()->input('sort','created_at'),request()->input('order','desc'));
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('user.create');

        return view('admin.user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('user.create');

        $user = new User();
        $user->forceFill($request->data);

        $password = $request->password;
        $user->password = bcrypt($password);
        $user->save();

        return flash('Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        if(auth()->id() > 1)
//            $this->authorize('users.view');
//
//        $transaction = Transaction::whereUserId($user->id)
//            ->when(date_range(),function ($q, $date){
//                $q->whereBetween('created_at', [$date['from']->startOfDay(), $date['to']->endOfDay()]);
//            })
//            ->orderByDesc('created_at')
//            ->get();
//
//        return  view('admin.user.transaction',compact('user','transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('user.edit');

        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('user.edit');

        $user->forceFill($request->data);
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return  flash('Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('user.destroy');

        $user->delete();
        return flash('Xóa thành công', 1);
    }

}
