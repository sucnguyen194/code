@extends('admin.layouts.layout')
@section('title') Bảng điều khiển
@stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Bảng điều khiển </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Bảng điều khiển</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
   
        @can('order.view')
        <div class="row">
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom ">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"> <i class="pe-7s-cash avatar-title font-30 text-white"></i> </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">Doanh thu tháng</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($total_month)}}</span> VNĐ</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom ">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"> <i class="pe-7s-cash avatar-title font-30 text-white"></i> </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">Lợi nhuận tháng</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($revenues_month)}}</span> VNĐ</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom ">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"> <i class="fe-alert-octagon avatar-title font-30 text-white"></i> </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">Tổng công nợ (KH)</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($user_debt)}}</span> VNĐ</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom ">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"> <i class="fe-alert-octagon avatar-title font-30 text-white"></i> </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">Tổng công nợ (NCC)</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"></span> VNĐ</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title">Biểu đồ theo tháng</h4>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">

                                    <h3 class="mb-2"><span data-plugin="counterup">{{$today}}</span></h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Đơn hàng hôm nay</p>
                                    @if($per_order >= 0)
                                        <p class="text-success">+{{$per_order}}% <i class="mdi mdi-trending-up"></i></p>
                                    @else
                                        <p class="text-danger">{{$per_order}}% <i class="mdi mdi-trending-down"></i></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h3 class="mb-2"><span data-plugin="counterup">{{number_format($total_today)}}</span> VNĐ</h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Danh thu hôm nay</p>
                                    @if($percent >= 0)
                                        <p class="text-success">+{{$percent}}% <i class="mdi mdi-trending-up"></i></p>
                                    @else
                                        <p class="text-danger">{{$percent}}% <i class="mdi mdi-trending-down"></i></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h3 class="mb-2"><span data-plugin="counterup">{{number_format($revenues_today)}}</span> VNĐ</h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Lợi nhuận hôm nay</p>
                                    @if($percent_revenues >=0)
                                        <p class="text-success">+{{$percent_revenues}}% <i class="mdi mdi-trending-up"></i></p>
                                    @else
                                        <p class="text-danger">{{$percent_revenues}}% <i class="mdi mdi-trending-down"></i></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chart" dir="ltr"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @endcan

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card-box">
                    <h4 class="header-title">Nội dung gần đây</h4>
                    <p class="sub-header">

                    </p>

                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-actions-bar">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Tác giả</th>
                                <th>Tạo lúc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Translation::whereNotNull('product_id')->orWhereNotNull('post_id')->locale()->latest('id')->take(10)->get() as $key => $translation)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                   <a href="{{route('slug',$translation->slug)}}" target="_blank"> {{$translation->name}}</a>
                                </td>
                                <td>
                                    {{$translation->item->admin->name}}
                                </td>
                                <td>
                                    {{$translation->item->created_at->diffForHumans()}}
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- end col -->
        </div>
        <div class="card-box">
            <div class="tool-share">
                <div class="w-100 mb-1"><a href="https://developers.facebook.com/tools/debug/" class="font-weight-bold" target="_blank">1. Tool sửa lỗi share facebook</a></div>
                <div class="w-100 mb-1"><a href="https://developers.zalo.me/tools/debug-sharing" class="font-weight-bold" target="_blank">2. Tool sửa lỗi share zalo</a></div>
                <div class="w-100 font-italic">* Click vào tool cần sửa lỗi -> past đường dẫn của bài viết vào thanh công cụ của tool</div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!--C3 Chart-->
    <script src="/lib/assets/libs/d3/d3.min.js"></script>
    <script src="/lib/assets/libs/c3/c3.min.js"></script>

    <!-- Init js -->
    <script src="/lib/assets/js/pages/c3.init.js"></script>

    <script>
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                x: 'x',
                columns: [
                    ['x', '{!!   implode("','", array_keys($revenues)) !!}'],
                    ['Doanh thu',{{ implode(',', $total) }}],
                    ['Lợi nhuận',{{ implode(',', $revenues) }}],
                ],
                type: 'bar',
                colors: {
                    'Doanh thu': "#5553ce",
                    'Lợi nhuận': "#43b39c",

                }
            },
            tooltip: {
                show: true,
            },
            axis : {
                x : {
                    type : 'timeseries',
                    tick: {
                        format: '%d/%m/%Y'
                    }
                },
                y : {
                    tick: {
                        format: d3.format(",")
                    }
                },
            }
        });

    </script>
@endsection
@section('styles')
    <!-- C3 Chart css -->
    <link href="/lib/assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css" />
@stop
