@extends('admin.layouts.layout')
@section('title') {{__('lang.dashboard')}}
@stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">{{__('lang.dashboard')}} </li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.dashboard')}}</h4>
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
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('lang.monthly_revenue')}}</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($total_month)}}</span> vnd</h3>
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
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('lang.monthly_profit')}}</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($revenues_month)}}</span> vnd</h3>
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
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('lang.total_debt')}} ({{__('lang.customer')}})</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{number_format($user_debt)}}</span> vnd</h3>
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
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('lang.total_debt')}} ({{__('lang.vendor')}})</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"></span> vnd</h3>
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
                    <h4 class="header-title">{{__('lang.chart_by_month')}}</h4>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">

                                    <h3 class="mb-2"><span data-plugin="counterup">{{$today}}</span></h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('lang.order_today')}}</p>
                                    @if($per_order >= 0)
                                        <p class="text-success">+{{$per_order}}% <i class="mdi mdi-trending-up"></i></p>
                                    @else
                                        <p class="text-danger">{{$per_order}}% <i class="mdi mdi-trending-down"></i></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h3 class="mb-2"><span data-plugin="counterup">{{number_format($total_today)}}</span> vnd</h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('lang.today_revenue')}}</p>
                                    @if($percent >= 0)
                                        <p class="text-success">+{{$percent}}% <i class="mdi mdi-trending-up"></i></p>
                                    @else
                                        <p class="text-danger">{{$percent}}% <i class="mdi mdi-trending-down"></i></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h3 class="mb-2"><span data-plugin="counterup">{{number_format($revenues_today)}}</span> vnd</h3>
                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('lang.profit_today')}}</p>
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
        <div class="card-box">
            <div class="tool-share">
                <div class="w-100 mb-1"><a href="https://developers.facebook.com/tools/debug/" class="font-weight-bold" target="_blank">1. {{__('lang.error_share_facebook')}}</a></div>
                <div class="w-100 mb-1"><a href="https://developers.zalo.me/tools/debug-sharing" class="font-weight-bold" target="_blank">2. {{__('lang.error_share_zalo')}}</a></div>
                <div class="w-100 font-italic">* {{__('lang.tool_note')}}</div>
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
                    ['{{__("lang.revenue")}}',{{ implode(',', $total) }}],
                    ['{{__("lang.profit")}}',{{ implode(',', $revenues) }}],
                ],
                type: 'bar',
                colors: {
                    '{{__("lang.revenue")}}': "#5553ce",
                    '{{__("lang.profit")}}': "#43b39c",
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
