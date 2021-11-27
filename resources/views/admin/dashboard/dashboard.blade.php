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
            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-two widget-two-custom ">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center"> <i class="pe-7s-cart avatar-title font-30 text-white"></i> </div>
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate">{{__('lang.order')}}</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{\App\Models\Order::count()}}</span></h3>
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

        </div>
        @endcan
        <!-- end row -->
        <div class="row">
            @can('order.view')
                <div class="col-lg-6">
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
            @endcan
            <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="header-title mb-4">{{__('lang.statistics')}}</h4>

                    <ul class="nav nav-tabs tabs-bordered nav-justified">
                        <li class="nav-item">
                            <a href="#visitor" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none">{{__('lang.access')}}</span>
                                <span class="d-none d-sm-block">{{__('lang.access')}}</span>
                            </a>
                        </li>
                        @can('product.view')
                        <li class="nav-item">
                            <a href="#top-product" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none">{{__('lang.product')}}</span>
                                <span class="d-none d-sm-block">{{__('lang.top')}} {{\Illuminate\Support\Str::lower(__('lang.product'))}}</span>
                            </a>
                        </li>
                        @endcan

                        @can('blog.view')
                        <li class="nav-item">
                            <a href="#top-post" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none">{{__('lang.post')}}</span>
                                <span class="d-none d-sm-block">{{__('lang.top')}} {{\Illuminate\Support\Str::lower(__('lang.post'))}}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                    <div class="tab-content h-100">
                        <div class="tab-pane active" id="visitor" style="height: 334px">
                            <table class="table table-bordered table-hover bs-table"
                                   data-side-pagination="server"
                                   data-page-size="5"
                                   data-pagination="true"
                                   data-search="false"
                                   data-show-refresh="false"
                                   data-show-columns="false"
                                   data-show-export="false"
                                   data-search-on-enter-key="false"
                                   data-show-search-button="false"
                                   data-sort-name="created_at"
                                   data-sort-order="desc"
                                   data-filename="visitors"
                                   data-cookie="true"
                                   data-cookie-id-table="visitors"
                            >
                                <thead>
                                <tr>
                                    <th data-width="100" data-sortable="true">#</th>
                                    <th>
                                        {{__('lang.source')}}
                                    </th>

                                    <th data-field="admin.name">
                                        {{__('lang.number_turns')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Models\Vistor::selectRaw('SUM(referer_count) as count, referer_domain')->groupByRaw('referer_domain')->latest('count')->get() as $key => $visitor)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="{{$visitor->referer_domain}}" target="_blank" class="font-weight-bold">{{$visitor->referer_domain}}</a> </td>
                                        <td>{{$visitor->count}}</td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                        @can('product.view')
                        <div class="tab-pane" id="top-product" style="height: 334px">
                            <table class="table table-bordered table-hover bs-table"
                                   data-side-pagination="server"
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
                                        {{__('lang.product')}}
                                    </th>

                                    <th data-field="view" data-width="150" >
                                        {{__('lang.number_turns')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Models\Product::ofTranslation()->where('view', '>',0)->latest('view')->take(50)->get() as  $key=>$product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="{{$product->slug}}" target="_blank" class="font-weight-bold">{{$product->name}}</a> </td>
                                        <td>{{$visitor->view}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endcan
                            @can('blog.view')
                        <div class="tab-pane" id="top-post" style="height: 334px">
                            <table class="table table-bordered table-hover bs-table"
                                   data-side-pagination="server"
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
                                        {{__('lang.post')}}
                                    </th>

                                    <th data-field="view" data-width="150" >
                                        {{__('lang.number_turns')}}
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach(\App\Models\Post::where('view', '!=' ,0)->latest('view')->take(50)->get() as  $key=>$post)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="{{$post->slug}}" target="_blank" class="font-weight-bold">{{$post->title}}</a> </td>
                                        <td>{{$post->view}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                            @endcan
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

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
