@extends('layouts.layout')
@section('title') Checkout @stop
@section('content')
    <section class="all-sections pt-60" id="app-checkout">
        <div class="container-fluid p-max-sm-0">
            <div class="sections-wrapper d-flex flex-wrap justify-content-center">
                <article class="main-section">
                    <div class="section-inner">
                        <div class="item-section">
                            <div class="container">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-details-area">
                                            <div class="item-card-wrapper border-0 p-0 list-view">
                                                <div class="item-card">
                                                    <div class="item-card-thumb">
                                                        <img src="{{$order->product->image}}" alt="item-banner">
                                                        <div class="item-level">Featured</div>
                                                    </div>
                                                    <div class="item-card-content">
                                                        <div class="item-card-content-top">
                                                            <div class="left" style="opacity: 0">
                                                                <div class="author-thumb">
                                                                    <img src="https://script.viserlab.com/viserlance/assets/images/user.jpg" alt="fordsesa">
                                                                </div>
                                                                <div class="author-content">
                                                                    <h5 class="name"><a href="https://script.viserlab.com/viserlance/user/fordsesa">fordsesa</a> <span class="level-text"> level-5</span></h5>
                                                                    <div class="ratings">
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="rating me-2">2.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right d-flex flex-wrap align-items-center">
{{--                                                                <select class="select me-3 selectQty" id="qty">--}}
{{--                                                                    <option value="1">1</option>--}}
{{--                                                                    <option value="2">2</option>--}}
{{--                                                                    <option value="3">3</option>--}}
{{--                                                                    <option value="4">4</option>--}}
{{--                                                                    <option value="5">5</option>--}}
{{--                                                                    <option value="6">6</option>--}}
{{--                                                                    <option value="7">7</option>--}}
{{--                                                                    <option value="8">8</option>--}}
{{--                                                                    <option value="9">9</option>--}}
{{--                                                                    <option value="10">10</option>--}}
{{--                                                                    <option value="11">11</option>--}}
{{--                                                                    <option value="12">12</option>--}}
{{--                                                                    <option value="13">13</option>--}}
{{--                                                                    <option value="14">14</option>--}}
{{--                                                                    <option value="15">15</option>--}}
{{--                                                                    <option value="16">16</option>--}}
{{--                                                                    <option value="17">17</option>--}}
{{--                                                                    <option value="18">18</option>--}}
{{--                                                                    <option value="19">19</option>--}}
{{--                                                                    <option value="20">20</option>--}}
{{--                                                                    <option value="21">21</option>--}}
{{--                                                                    <option value="22">22</option>--}}
{{--                                                                    <option value="23">23</option>--}}
{{--                                                                    <option value="24">24</option>--}}
{{--                                                                    <option value="25">25</option>--}}
{{--                                                                    <option value="26">26</option>--}}
{{--                                                                    <option value="27">27</option>--}}
{{--                                                                    <option value="28">28</option>--}}
{{--                                                                    <option value="29">29</option>--}}
{{--                                                                    <option value="30">30</option>--}}
{{--                                                                    <option value="31">31</option>--}}
{{--                                                                    <option value="32">32</option>--}}
{{--                                                                    <option value="33">33</option>--}}
{{--                                                                    <option value="34">34</option>--}}
{{--                                                                    <option value="35">35</option>--}}
{{--                                                                    <option value="36">36</option>--}}
{{--                                                                    <option value="37">37</option>--}}
{{--                                                                    <option value="38">38</option>--}}
{{--                                                                    <option value="39">39</option>--}}
{{--                                                                    <option value="40">40</option>--}}
{{--                                                                    <option value="41">41</option>--}}
{{--                                                                    <option value="42">42</option>--}}
{{--                                                                    <option value="43">43</option>--}}
{{--                                                                    <option value="44">44</option>--}}
{{--                                                                    <option value="45">45</option>--}}
{{--                                                                    <option value="46">46</option>--}}
{{--                                                                    <option value="47">47</option>--}}
{{--                                                                    <option value="48">48</option>--}}
{{--                                                                    <option value="49">49</option>--}}
{{--                                                                    <option value="50">50</option>--}}
{{--                                                                </select>--}}
                                                                <div class="item-amount">${{$order->usd}}</div>
                                                            </div>
                                                        </div>
                                                        <h3 class="item-card-title"><a href="{{$order->product->slug}}">{{$order->product->name}}</a></h3>
                                                    </div>
{{--                                                    <div class="item-card-footer">--}}
{{--                                                        <div class="left">--}}
{{--                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="107"><i class="fas fa-heart"></i> <span class="give-love-amount">(3)</span></a>--}}
{{--                                                            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> (2)</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>


                                            <div class="product-desc mt-80">
                                                <div class="section-header">
                                                    <h2 class="section-title">Service Description</h2>
                                                </div>
                                                <div class="product-desc-content pt-0">
                                                    {!! $order->product->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 mb-30">
                                        <div class="sidebar">
                                            <div class="widget  custom-widget mb-30">
                                                <h3 class="widget-title">Your Order</h3>
                                                <ul class="details-list">
                                                    <li><span>Service Price :</span>
                                                        <div class="order-price-tags">
                                                            <span>$</span>
                                                            <span id="servicePrice">@{{ usd }}</span>
                                                        </div>
                                                    </li>

                                                    <li><span>Quantity :</span>
                                                        <span id="qunatity">@{{ amount }}</span>
                                                    </li>

                                                    <li><span>Subtotal :</span>
                                                        <div class="order-price-tags">
                                                            <span>$</span> <span id="totalPrice">@{{ sub_total }}</span>
                                                        </div>
                                                    </li>

                                                    <li v-if="payment_type == 1 || payment_type == 2"><span>Rate :</span>
                                                        <span id="qunatity">@{{ rate.toLocaleString() }} vnd</span>
                                                    </li>

{{--                                                    <div id="discount">--}}

{{--                                                    </div>--}}

                                                </ul>
                                                <div class="total-price-area d-flex flex-wrap align-items-center justify-content-between border-bottom mb-20">
                                                    <div class="left">
                                                        <h4 class="title">Total :</h4>
                                                    </div>
                                                    <div class="right">
                                                        <h4 class="title"><span v-if="payment_type == 0 || payment_type == 3">$</span> <span id="paymentPrice">@{{ total }}</span> <span v-if="payment_type == 1 || payment_type == 2">vnd</span></h4>
                                                    </div>
                                                </div>
{{--                                                <form class="coupon-form mt-20">--}}
{{--                                                    <input type="text" class="form-control" id="couponCode" placeholder="Coupon Code">--}}
{{--                                                    <button type="button" class="coupon-form-btn" id="couponApply"><i class="las la-angle-right"></i></button>--}}
{{--                                                </form>--}}
                                                <form method="post" v-bind:action="router">
                                                    @csrf

                                                    <h3 class="widget-title">Payment methods</h3>
                                                    <div class="form-group">
                                                        @if(setting('checkout.vcb'))
                                                        <label class="d-flex" for="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::Vietcombank)}}">
                                                            <input type="radio" style="width: 30px; margin-top: 5px" v-model="payment_type" name="payment_type" value="{{\App\Enums\PaymentType::Vietcombank}}" id="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::Vietcombank)}}"> {{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::Vietcombank)}}
                                                        </label>
                                                        <div class="form-text" v-if="payment_type == 1">
                                                            {!! setting('checkout.vcb_body') !!}
                                                        </div>

                                                        @endif

                                                            @if(setting('checkout.nl'))
                                                        <label class="d-flex" for="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::NganLuong)}}">
                                                            <input type="radio" id="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::NganLuong)}}" style="width: 30px; margin-top: 5px" v-model="payment_type" name="payment_type" value="{{\App\Enums\PaymentType::NganLuong}}"> {{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::NganLuong)}}
                                                        </label>
                                                            @endif

                                                            @if(setting('checkout.pm'))

                                                        <label class="d-flex" for="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::PerfectMoney)}}">
                                                            <input type="radio" style="width: 30px; margin-top: 5px" v-model="payment_type" name="payment_type" value="{{\App\Enums\PaymentType::PerfectMoney}}" id="{{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::PerfectMoney)}}"> {{\App\Enums\PaymentType::getDescription(\App\Enums\PaymentType::PerfectMoney)}}
                                                        </label>

                                                            @endif

                                                        <div class="d-none" v-if="payment_type == 3">
                                                            <input type="hidden" name="PAYEE_ACCOUNT" value="{{setting('checkout.payee_account')}}">
                                                            <input type="hidden" name="PAYEE_NAME" value="{{setting('checkout.payee_name')}}">
                                                            <input type="hidden" name="PAYMENT_AMOUNT" value="{{$order->usd}}">
                                                            <input type="hidden" name="PAYMENT_UNITS" value="{{setting('checkout.payee_units')}}">
{{--                                                            <input type="hidden" name="PAYMENT_ID" value="CP625016069EBFA">--}}
                                                            <input type="hidden" name="STATUS_URL" value="{{route('order.checkout', $order->id)}}">
                                                            <input type="hidden" name="PAYMENT_URL" value="{{route('order.checkout', $order->id)}}">
                                                            <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
                                                            <input type="hidden" name="NOPAYMENT_URL" value="{{route('order.checkout', $order->id)}}">
                                                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
{{--                                                            <input type="hidden" name="SUGGESTED_MEMO" value=" CP625016069EBFA">--}}
                                                        </div>

                                                    </div>
                                                    <p class="text-danger" v-if="payment_type == 0">* Please select payment methods</p>
                                                    <div class="widget-btn mt-20">
                                                        <button type="submit" :disabled="!payment_type" class="btn--base w-100"><i class="las la-sign-in-alt"></i> Checkout</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <style>
        .form-text {
            background: #20c997;
            padding: 5px 10px;
            border-radius: 10px;
            overflow: hidden;
            color: #fff;
            margin-bottom: 10px;
        }
        .form-text p {
            margin-bottom: 0px!important;
        }
    </style>
@stop


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

    <script type="text/javascript">

        var app = new Vue({
            el: '#app-checkout',
            mounted:function(){
                var vm = this;
            },
            data:{
                payment_type:0,
                usd: {{$order->usd}},
                vnd: {{$order->vnd}},
                rate:{{$order->rate}},
                amount: {{$order->amount}},
                sub_total: {{$order->usd * $order->amount}},
                route: "{{route('order.checkout', $order->id)}}",
                route_pm: "https://perfectmoney.com/api/step1.asp",
            },

            watch: {

            },
            computed:{
                total:function (){
                    var total = this.payment_type == 3 || this.payment_type == 0 ? this.sub_total : (this.sub_total * this.rate).toLocaleString();

                    return total;
                },
                router:function(){
                    var router = this.payment_type == 3 ? this.route_pm : this.route;

                    return router;
                }
            }
        })
    </script>

@stop
