<?php namespace App\Http\Controllers;
use App\Enums\Activation;
use App\Jobs\OrderSend;
use App\Models\Discount;
use App\Models\Order;
use DB,Cart,Mail;
use Illuminate\Http\Request;

class OrderController extends Controller {

	public function index(){

	    $orders = Order::whereUserId(auth()->id())->latest()->paginate(20);

		return view('Order.shoppingcart',compact('orders'));
	}
	public function checkout(){
	    $cart = Cart::content();
		return view('Order.checkout',compact('cart'));
	}


//    public function store(Request $request){
//
//        $order = new Order();
//        $order->forceFill($request->data);
//        $order->user_id = auth()->id() ?? 0;
//        $order->content = json_encode(Cart::content());
//        $order->total = Cart::subtotal(0);
//        $order->save();
//
//       // OrderSend::dispatch($order)->onQueue('default');
//
//        return flash('Đặt hàng thành công! Chúng tôi sẽ liên hệ lại trong thời gian sớm nhất!');
//    }

    public function store(Request $request){

        $order = new Order();
        $order->forceFill($request->data);
        $order->user_id = auth()->id() ?? 1;
        $order->total = Cart::subtotal(0);
        $order->content = json_encode(Cart::content());
        $order->save();

        OrderSend::dispatch($order)->onQueue('default');
        Cart::destroy();
        return flash('Đặt hàng thành công! Chúng tôi sẽ liên hệ lại trong thời gian sớm nhất!');
    }
	public function destroy(){
		Cart::destroy();
		return redirect(url());
	}
	public function remove($rowid){
		Cart::remove($rowid);
		return redirect()->back();
	}

//	public function discount(Request  $request){
//        //Coupon
//        $discount_value = null;
//        if ($request->coupon){
//            $discount = Discount::where('code', $request->coupon)->first();
//
//            if (!$discount || $discount->status != Activation::true()){
//                return flash('Mã giảm giá không đúng',0);
//            }
//
//            if ( ($discount->start_at && $discount->start_at->isFuture()) || ($discount->end_at && $discount->end_at->isPast())){
//                return flash('Mã đã hết hạn hoặc chưa thể sử dụng', 0);
//            }
//
//            if ($discount->minimum_quantity && $order->quantity < $discount->minimum_quantity){
//                return flash('Yêu cầu số lượng tối thiểu: '.$discount->minimum_quantity, 0);
//            }
//
//            if ($discount->minimum_amount && ($order->quantity * $order->price) < $discount->minimum_amount){
//                return flash('Yêu cầu số tiền tối thiểu: '.number($discount->minimum_amount), 0);
//            }
//
//            if ($discount->user_selection == 'users'){
//                if (!$discount->users()->where('user_id', auth()->id())->count()){
//                    return flash('Mã giảm giá không dành cho bạn', 0);
//                }
//            }
//
//            //Check dịch vụ
//            if (!$discount->services()->where('id', $order->product->service->id)->exists()){
//                return flash('Mã giảm giá không áp dụng cho dịch vụ này', 0);
//            }
//
//            //check số lần sử dụng
//            if ($discount->uses_total){
//                if ( $discount->invoices()->count() >= $discount->uses_total)
//                    return flash('Mã giảm giá đã được sử dụng hết', 0);
//            }
//
//            if ($discount->uses_user){
//                if ($discount->invoices()->where('user_id', $order->user_id)->count() >= $discount->uses_user){
//                    return flash('Mã giảm giá này chỉ được áp dụng '.$discount->uses_user.' lần cho mỗi tài khoản', 0);
//                }
//            }
//
//
//            if ($discount->value_type){
//                $discount_value = $discount->value;
//            }else{
//                $discount_value = $order->sub_total * $discount->value/100;
//            }
//
//            $order->voucher = $request->coupon;
//
//            $order->total = ($order->quantity * $order->price) - $discount_value;
//            $order->total = $order->total < 0 ? 0 : $order->total;
//
//            flash('Áp dụng mã giảm giá thành công', 1);
//        }else{
//            $order->voucher = null;
//        }
//    }
}
