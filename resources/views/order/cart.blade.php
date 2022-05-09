@extends('layouts.layout')
@section('title') My cart @stop
@section('content')
    <section class="all-sections ptb-60">
        <div class="container-fluid">
            <div class="section-wrapper">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-3 col-lg-3 mb-30">
                        <div class="dashboard-sidebar">
                            <button type="button" class="dashboard-sidebar-close"><i class="fas fa-times"></i></button>
                            <div class="dashboard-sidebar-inner">
                                <div class="dashboard-sidebar-wrapper-inner">
                                    <h5 class="menu-header-title">Sidebar</h5>
                                    <ul id="sidebar-main-menu" class="sidebar-main-menu">

                                        <li class="sidebar-single-menu nav-item open">
                                            <a href="{{route('order.cart')}}">
                                                <i class="las la-list"></i> <span class="title">Order list</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-single-menu nav-item ">
                                            <a href="https://script.viserlab.com/viserlance/user/seller/service/create">
                                                <i class="las la-plus"></i> <span class="title">Create Service</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-single-menu nav-item ">
                                            <a href="https://script.viserlab.com/viserlance/user/seller/software">
                                                <i class="lab la-microsoft"></i> <span class="title">Manage Software</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-single-menu nav-item ">
                                            <a href="https://script.viserlab.com/viserlance/user/seller/software/upload">
                                                <i class="las la-plus"></i> <span class="title">Upload Software</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-12 mb-30">
                        <div class="dashboard-sidebar-open"><i class="las la-bars"></i> Menu</div>
                        <div class="table-section">
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="table-area">
                                        <table class="custom-table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Service</th>
                                                <th>Amount</th>
                                                <th>Price</th>
                                                <th>Rate</th>
                                                <th>Vnd</th>
                                                <th>Status</th>
{{--                                                <th>Action</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($orders->count())

                                            @foreach($orders as $order)

                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$order->amount}}</td>
                                                <td>${{$order->usd}}</td>
                                                <td>{{number_format($order->rate)}} vnd</td>
                                                <td>{{number_format($order->vnd)}} vnd</td>

                                                <td class="text-{{\Illuminate\Support\Str::lower(\App\Enums\OrderStatus::getDescription($order->status))}}">{{\App\Enums\OrderStatus::getDescription($order->status)}}</td>
{{--                                                <td>No data found</td>--}}
                                            </tr>
                                            @endforeach

                                            @else
                                                <tr><td colspan="100%">No data found</td></tr>
                                            @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .text-pending {
            color: #0dcaf0!important;
        }

        .text-completed {
            color: #20c997!important;
        }

        .text-error {
            color: #dc3545!important;
        }

        .text-canceled {
            color: #6c757d!important;
        }

        .text-confirming {
            color: #6610f2!important;
        }
    </style>

@stop
