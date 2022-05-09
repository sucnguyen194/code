<?php namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\NlCheckout;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::whereUserId(auth()->id())->latest()->paginate(20);

        return view('order.index', compact('orders'));
    }

    public function cart()
    {

        $orders = auth()->user()->orders->load('product');

        return view('order.cart', compact('orders'));
    }

    public function checkout(Request $request, $id)
    {

        $order = Order::with('product')->whereStatus(OrderStatus::pending)->find($id);

        if (!$order)
            return flash('Invalid order', 0, route('order.cart'));

        return view('order.checkout', compact('order'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'price'      => 'required|numeric|min:1',
            'product_id' => 'required|numeric|min:1',
            'amount'     => 'required|numeric|min:1'
        ]);

        $product_id = $request->product_id;

        if (!Product::find($product_id))
            return flash('Product does not exist', 0);

        $order = new Order();

        $order->product_id = $product_id;
        $order->user_id = auth()->id();
        $order->rate = setting('checkout.rate');
        $order->usd = $request->price;
        $order->amount = $request->amount;
        $order->vnd = $order->usd * $order->rate;
        $order->status = OrderStatus::pending;

        $order->save();

        //OrderSend::dispatch($order)->onQueue('default');

        return flash('Order success', 1, route('order.checkout', $order->id));
    }

    public function payment(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order)
            return flash('Order not found', 0);

        define('ALTERNATE_PHRASE_HASH', setting('checkout.hash_check'));

        $string =
            $request->input('PAYMENT_ID') . ':' . $request->input('PAYEE_ACCOUNT') . ':' .
            $request->input('PAYMENT_AMOUNT') . ':' . $request->input('PAYMENT_UNITS') . ':' .
            $request->input('PAYMENT_BATCH_NUM') . ':' .
            $request->input('PAYER_ACCOUNT') . ':' . ALTERNATE_PHRASE_HASH . ':' .
            $request->input('TIMESTAMPGMT');

        $hash = strtoupper(md5($string));

        if ($hash === $_POST['V2_HASH']) { // processing payment if only hash is valid

            if ($request->input('PAYMENT_AMOUNT') == $order->usd && $request->input('PAYEE_ACCOUNT') == setting('checkout.payee_account') && $request->input('PAYMENT_UNITS') == setting('checkout.payee_units')) {

                $order->payment_type = PaymentType::PerfectMoney;
                $order->status = OrderStatus::completed;
                $order->save();

                return redirect()->route('order.cart');
            } else {
                $order->payment_type = PaymentType::PerfectMoney;
                $order->save();
                return flash('Payment failed! ', 0, route('order.checkout', $id));
            }
        } else {

            $payment_type = $request->payment_type;

            if (!in_array($payment_type, PaymentType::getValues()))
                return flash('Payment type not found', 0);

            if ($payment_type === PaymentType::Vietcombank && !setting('checkout.vcb'))
                return flash('Payment type not found', 0);

            if ($payment_type === PaymentType::NganLuong && !setting('checkout.nl]'))
                return flash('Payment type not found', 0);

            if ($payment_type === PaymentType::PerfectMoney && !setting('checkout.pm]'))
                return flash('Payment type not found', 0);


            if ($payment_type == PaymentType::NganLuong) {
                $nl = new NlCheckout();
                return $nl->checkout($order);

            } elseif ($payment_type == PaymentType::PerfectMoney) {

            } else {
                $order->payment_type = PaymentType::Vietcombank;
                $order->payment_code = Str::random($id);
                $order->status = OrderStatus::confirming;
                $order->save();

                return flash('Order has been sent!', 1, route('order.cart'));
            }

        }

    }


    public function vcbSuccess()
    {

    }

    public function nlSuccess(Request $request)
    {

        if ($request->payment_id) {
            // Lấy các tham số để chuyển sang Ngânlượng thanh toán:

            $transaction_info = $request->transaction_info;
            $order_code = $request->order_code;
            $price = $request->price;
            $payment_id = $request->payment_id;
            $payment_type = $request->payment_type;
            $error_text = $request->error_text;
            $secure_code = $request->secure_code;
            //Khai báo đối tượng của lớp NL_Checkout
            $nl = new NlCheckout();

            $nl->merchant_site_code = setting('checkout.nl_merchant_id');
            $nl->secure_pass = setting('checkout.nl_merchant_pass');
            //Tạo link thanh toán đến nganluong.vn
            $checkpay = $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);


            $order = Order::wherePaymentCode($order_code)->first();

            if ($checkpay && $order) {
                $response = 'Payment success';
                // bạn viết code vào đây để cung cấp sản phẩm cho người mua
                $order->status = OrderStatus::completed;
            } else {
                $response = 'Payment failed! Order not found!';
                $order->status = OrderStatus::error;
            }

            $order->note = $error_text;
            $order->save();

            return view('order.nl_success', compact('response', 'order'));
        }

    }
}
