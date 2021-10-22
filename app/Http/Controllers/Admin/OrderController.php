<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LeverUser;
use App\Enums\ProductSessionType;
use App\Enums\SystemType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSession;
use App\Models\User;
use App\Models\UserAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart,Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->id() > 1) $this->authorize('order.view');

        return view('admin.order.index');
    }

    public function data(){
        $orders = Order::query()->with('user')
            ->when(\request()->status,function($q, $status){
                $q->whereStatus($status);
            })
            ->when(date_range(), function ($q, $range){
                $q->whereBetween('created_at', [$range['from']->startOfDay(), $range['to']->endOfDay()]);
            });

        return datatables()->of($orders)
            ->editColumn('created_at',function($order){
                return $order->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('amount',function($order){
                return $order->amount;
            })
            ->order(function ($q){
                $q->orderBy(\request()->input('sort','created_at'),\request()->input('order','desc'));
            })->make(true);
    }

    public function print($id){

        $order = Order::find($id);

        if(!$order)
            return flash('Đơn hàng không tồn tại!',4);

        return  view('admin.order.print',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(auth()->id() > 1) $this->authorize('order.view');
        return view('admin.order.edit',compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(auth()->id() > 1) $this->authorize('order.destroy');

        $order->delete();
        return flash('Xóa thành công!');
    }
}
