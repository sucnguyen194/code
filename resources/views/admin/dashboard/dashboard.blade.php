@extends('admin.layouts.layout')
@section('title', __('_dashboard'))
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">{{__('_dashboard')}} </li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_dashboard')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @can('order.view')
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-two widget-two-custom ">
                        <div class="media">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"><i
                                    class="pe-7s-cart avatar-title font-30 text-white"></i></div>
                            <div class="wigdet-two-content media-body">
                                <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('_order')}}</p>
                                <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{\App\Models\Order::count()}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-two widget-two-custom ">
                        <div class="media">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"><i
                                    class="pe-7s-cash avatar-title font-30 text-white"></i></div>
                            <div class="wigdet-two-content media-body">
                                <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('_monthly_revenue')}}</p>
                                <h3 class="font-weight-medium my-2"><span
                                        data-plugin="counterup">{{number_format($total_month)}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-two widget-two-custom ">
                        <div class="media">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"><i
                                    class="pe-7s-cash avatar-title font-30 text-white"></i></div>
                            <div class="wigdet-two-content media-body">
                                <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('_monthly_profit')}}</p>
                                <h3 class="font-weight-medium my-2"><span
                                        data-plugin="counterup">{{number_format($revenues_month)}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-two widget-two-custom ">
                        <div class="media">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"><i
                                    class="fe-alert-octagon avatar-title font-30 text-white"></i></div>
                            <div class="wigdet-two-content media-body">
                                <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('_debt')}}</p>
                                <h3 class="font-weight-medium my-2"><span
                                        data-plugin="counterup">{{number_format($user_debt)}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        @endcan
    <!-- end row -->
        <div class="row">
            @can('order.view')
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title">{{__('_chart_by_month')}}</h4>

                        <div class="text-center">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">

                                        <h3 class="mb-2"><span data-plugin="counterup">{{$today}}</span></h3>
                                        <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('_order_today')}}</p>
                                        @if($per_order >= 0)
                                            <p class="text-success">+{{$per_order}}% <i class="mdi mdi-trending-up"></i>
                                            </p>
                                        @else
                                            <p class="text-danger">{{$per_order}}% <i class="mdi mdi-trending-down"></i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <h3 class="mb-2"><span
                                                data-plugin="counterup">{{number_format($total_today)}}</span>
                                        </h3>
                                        <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('_today_revenue')}}</p>
                                        @if($percent >= 0)
                                            <p class="text-success">+{{$percent}}% <i class="mdi mdi-trending-up"></i>
                                            </p>
                                        @else
                                            <p class="text-danger">{{$percent}}% <i class="mdi mdi-trending-down"></i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <h3 class="mb-2"><span
                                                data-plugin="counterup">{{number_format($revenues_today)}}</span>
                                        </h3>
                                        <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('_profit_today')}}</p>
                                        @if($percent_revenues >=0)
                                            <p class="text-success">+{{$percent_revenues}}% <i
                                                    class="mdi mdi-trending-up"></i></p>
                                        @else
                                            <p class="text-danger">{{$percent_revenues}}% <i
                                                    class="mdi mdi-trending-down"></i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="chart" dir="ltr"></div>
                    </div>
                </div>
            @endcan
            <div class="col-lg-7">
                <div class="card-box col-statistics">
                    <h4 class="header-title mb-4">{{__('_statistics')}} </h4>
                    <ul class="nav nav-tabs statistics tabs-bordered">
                        @can('blog.view')
                            <li class="nav-item">
                                <a href="#top-post" data-toggle="tab" aria-expanded="false"
                                   class="nav-link">
                                    <span class="d-block d-sm-none">{{__('_top_post')}}</span>
                                    <span class="d-none d-sm-block">{{__('_top_post')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('product.view')
                            <li class="nav-item">
                                <a href="#top-product" data-toggle="tab" aria-expanded="false"
                                   class="nav-link">
                                    <span class="d-block d-sm-none">{{__('_top_product')}}</span>
                                    <span class="d-none d-sm-block">{{__('_top_product')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <div class="tab-content h-100">
                        @can('blog.view')
                            <div class="tab-pane" id="top-post">
                                <table class="table table-bordered table-hover bs-table"
                                       {{--                                                   data-side-pagination="server"--}}
                                       data-pagination="true"
                                       data-page-size="5"
                                       data-search="false"
                                       data-show-refresh="false"
                                       data-show-columns="false"
                                       data-show-export="false"
                                       data-search-on-enter-key="false"
                                       data-show-search-button="false"
                                       data-sort-name="created_at"
                                       data-sort-order="desc"
                                       data-filename="posts_most_views"
                                       data-cookie="true"
                                       data-cookie-id-table="posts_most_views"
                                >
                                    <thead>
                                    <tr>
                                        <th data-width="100" data-sortable="true">#</th>
                                        <th>
                                            {{__('_post')}}
                                        </th>

                                        <th data-field="view" data-width="150" data-sortable="true">
                                            {{__('_total_turn')}}
                                        </th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($posts as  $key=>$post)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><a href="{{$post->slug}}" target="_blank" title="{{$post->title}}"
                                                   class="font-weight-bold">{{str_limit($post->title,10)}}</a></td>
                                            <td>{{$post->view}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endcan

                        @can('product.view')
                            <div class="tab-pane" id="top-product">
                                <table class="table table-bordered table-hover bs-table"
                                       {{--                                                   data-side-pagination="server"--}}
                                       data-pagination="true"
                                       data-page-size="5"
                                       data-search="false"
                                       data-show-refresh="false"
                                       data-show-columns="false"
                                       data-show-export="false"
                                       data-search-on-enter-key="false"
                                       data-show-search-button="false"
                                       data-sort-name="view"
                                       data-sort-order="desc"
                                       data-filename="products_most"
                                       data-cookie="true"
                                       data-cookie-id-table="products_most"
                                >
                                    <thead>
                                    <tr>
                                        <th data-width="100" data-sortable="true">#</th>
                                        <th>
                                            {{__('_product')}}
                                        </th>

                                        <th data-field="view" data-width="150" data-sortable="true">
                                            {{__('_total_turn')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as  $keys=>$product)
                                        <tr>
                                            <td>{{$keys+1}}</td>
                                            <td><a href="{{$product->slug}}" target="_blank" title="{{$product->name}}"
                                                   class="font-weight-bold">{{str_limit($product->name,10)}}</a></td>
                                            <td>{{$product->view}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endcan

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-lg-5">
                <div class="card-box col-browser">
                    <h4 class="header-title mb-4 pb-3">{{__('_stats_browser')}}</h4>
                    <div class="text-center">
                        <div >
{{--                            <h3 class="mb-2"><span data-plugin="counterup">{{$sum_count}}</span></h3>--}}
{{--                            <p class="text-uppercase mb-1 font-13 font-weight-medium">{{__('_total_turn')}}</p>--}}
                            <div class="google-chart text-center">
                                <div class="chart mt-3" id="pie-3d-chart"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end content -->
            </div>

        </div>
        <!-- end row -->

        <div class="card-box">
            <div class="tool-share">
                <div class="w-100 mb-1"><a href="https://developers.facebook.com/tools/debug/"
                                           class="font-weight-bold"
                                           target="_blank">1. {{__('_error_share_facebook')}}</a></div>
                <div class="w-100 mb-1"><a href="https://developers.zalo.me/tools/debug-sharing"
                                           class="font-weight-bold"
                                           target="_blank">2. {{__('_error_share_zalo')}}</a></div>
                <div class="w-100 font-italic">* {{__('_tool_error_note')}}</div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!--C3 Chart-->
    <script src="/lib/assets/libs/d3/d3.min.js"></script>
    <script src="/lib/assets/libs/c3/c3.min.js"></script>

    <!-- Google Charts js -->
<script src="https://www.google.com/jsapi"></script>

<script>
    !function (c) {
        "use strict";
        var e = function () {
            this.$body = c("body")
        };
       e.prototype.createPieChart = function (e, t, a, o, r) {
            var n = {
                // fontName: "Montserrat",
                fontSize: 14,
                height: 400,
                // backgroundColor: {fill: "transparent"},
                chartArea: {left: 50, width: "90%", height: "90%"},
                legend: {textStyle: {fontSize: 14, color: "#98a6ad"}},
                //colors: a
            };
            o && (n.is3D = !0), r && (n.is3D = !0, n.pieSliceText = "label", n.slices = {
                2: {offset: .15},
                5: {offset: .1}
            });
            var i = google.visualization.arrayToDataTable(t), l = new google.visualization.PieChart(e);
            return l.draw(i, n), l
        },e.prototype.init = function () {
            var e = this,
             i = [
                 ["Task", "Hours per Day"],
                 @foreach($visitors as $visitor)
                 ["{{$visitor->referer_domain}}", {{$visitor->count}}],
                 @endforeach
             ];
            e.createPieChart(c("#pie-3d-chart")[0], i, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c", "#32c861"], !0, !1);
        }, c.GoogleChart = new e, c.GoogleChart.Constructor = e
    }(window.jQuery), function (e) {
        "use strict";
        google.load("visualization", "1", {packages: ["corechart"]}), google.setOnLoadCallback(function () {
            e.GoogleChart.init()
        })
    }(window.jQuery);
</script>

    <script>
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                x: 'x',
                columns: [
                    ['x', '{!!   implode("','", array_keys($revenues)) !!}'],
                    ['{{__("_revenue")}}',{{ implode(',', $total) }}],
                    ['{{__("_profit")}}',{{ implode(',', $revenues) }}],
                ],
                type: 'bar',
                colors: {
                    '{{__("_revenue")}}': "#5553ce",
                    '{{__("_profit")}}': "#43b39c",
                }
            },
            tooltip: {
                show: true,
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%d/%m/%Y'
                    }
                },
                y: {
                    tick: {
                        format: d3.format(",")
                    }
                },
            }
        });

    </script>

    <script>
        $('.statistics .nav-link').first().click();

        const width = $('html, body').width();

        if (width > 768) {
            const browser = $('.col-browser').height() + 400;
            $('.col-statistics').height(browser);
        }
    </script>
@stop

@section('styles')
    <!-- C3 Chart css -->
    <link href="/lib/assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css"/>
@stop
