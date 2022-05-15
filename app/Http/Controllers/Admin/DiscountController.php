<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('discount.view');
        return view('admin.discount.index');
    }


    public function data(Request $request)
    {

        $discounts = Discount::withCount(['invoices' =>function($q){
            $q->whereNotNull('paid_at');
        },'invoices as discount' =>function($q){
            $q->select(DB::raw('SUM(discount)'))->whereNotNull('paid_at');
        }])
            ->when(request()->search, function ($q, $keyword){
                return $q->where(function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%');
                });
            });

        return datatables()->of($discounts)
            ->addColumn('status', function ($wheel){
                return $wheel->status->description;
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
        $this->authorize('discount.create');

        $products = Product::select('id')->with('translation')->whereHas('translation')->latest()->public()->get();

        $users = User::select('id', 'name')->get();
        return view('admin.discount.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('discount.create');
        $discountData = $request->discount;
        Validator::make($discountData, [
            'name' => 'required',
            'code' => 'required',
            'value' => 'required|min:0',
            'value_type' => 'required'
        ])->validate();

        if ($discountData['value_type'] == 0 && $discountData['value'] > 100){
            return flash(__('lang.note_down_max'), 0);
        }

        $discount = Discount::create($discountData);
        $discount->products()->attach($request->products);

        if ($discount->user_selection == 'users' && $request->users){
            $discount->users()->sync($request->users);
        }

        return flash(__('_the_record_is_updated_successfully'), 1, route('admin.discounts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $this->authorize('discount.edit');

        $discount->load(['products'=> function($q){ $q->select('id')->with('translation')->whereHas('translation'); }]);

        $products = Product::select('id')->with('translation')->whereHas('translation')->latest()->public()->get();

        $users = User::select('id', 'name')->get();
        return view('admin.discount.edit', compact('discount', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $this->authorize('discount.edit');

        $discountData = $request->discount;
        Validator::make($discountData, [
            'name' => 'required',
            'code' => 'required|',
            'value' => 'required|min:0',
            'value_type' => 'required',
            'user_selection' => 'required',
        ])->validate();

        if ($discountData['value_type'] == 0 && $discountData['value'] > 100){
            return flash(__('lang.note_down_max'), 0);
        }

        $discount->fill($discountData);
        $discount->save();
        $discount->products()->sync($request->products);
        if ($discount->user_selection == 'users' && $request->users){
            $discount->users()->sync($request->users);
        }else{
            $discount->users()->detach();
        }


        return flash(__('_the_record_is_updated_successfully'), 1, route('admin.discounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $this->authorize('discount.destroy');

        $discount->delete();
        return flash(__('_the_record_is_deleted_successfully'));
    }

    public function history(Discount $discount){

        $invoices = Invoice::where('voucher', $discount->code)->with(['user' => function($q){
            $q->select('id', 'name', 'username');
        }])->whereNotNull('paid_at')->latest()->get();

        return view('admin.discount.history', compact('invoices', 'discount'));
    }
}
