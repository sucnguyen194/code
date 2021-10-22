@extends('layouts.layout')
@section('title') Giỏ hàng @stop
@section('content')
    <main class="main-site">
        <div class="art-breadcrumbs">
            <!--
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="breadcrumbs-content">
                                        <div class="image-box breadcrumb-image"> <img src="/frontend/images/bg-breadcrumb_1.jpg" alt="Breadcrumb"> </div>
                                        <div class="title-box title-breadcrumb">
                                            <h1 class="title">Đăng nhập</h1>
                                            <h2 style="display: none" class="title">Đăng nhập</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            -->
            <!--
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="breadcrumbs-content">
                                        <div class="content-box content-breadcrumb">
                                            <ul class="breadcrumb-box mt-3">
                                                <li> <a href="/" title="Trang chủ">Trang chủ</a> </li>
                                                <li> <span>Đăng nhập</span> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            -->
        </div>
        <!--breadcrumbs-->
        <div class="container">
            <div class="w-xs-100 w-75 m-auto">
                <article class="art-categories pt-4 pb-4">
                    <div class="slick-slider slick-categories">
                        @foreach(\App\Models\Product::with('Category')->whereType('Product')->public()->latest()->take(20)->get() as $product)
                            <div class="item">
                                <div class="categories-box">
                                    <div class="categories-image">
                                        <a href="{{route('alias',$product->alias)}}"><img src="{{asset($product->image)}}" alt="{{$product->name}}" class="w-100"> </a>
                                    </div>
                                    <div class="categories-content text-center d-none">
                                        <h4 class="categories-name">
                                            <a href="{{route('alias',$product->alias)}}">{{$product->name}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </article>
            </div>
        </div>
        <div class="page-site blogs-site mt-5">
            <div class="main-container">
                <article class="art-blogs">
                    <div class="container">
                        <div class="w-xs-100 w-75 m-auto">


                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->content['image']}}</td>
                                    <td>{{$order->content['name']}}</td>
                                    <td>{{number_format($order->content['price'])}} vnd</td>
                                    <td>{{$order->content['qty']}}</td>
                                    <td>{{number_format($order->content['qty'] * $order->content['price'])}} vnd</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {!! $orders->appends(request()->except(['page']))->links() !!}
                            </div>
                        </div>
                    </div>
                </article>
                <!-- art-blogs -->
            </div>
        </div>
    </main>
@stop
