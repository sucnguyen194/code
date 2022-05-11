@extends('admin.layouts.layout')
@section('title') {{__('_order')}} @stop
@section('content')
    <div class="container-fluid" id="orders-index">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_order')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_order')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">

                            <div class="mr-2 mb-2" style="width: 200px">
                                <input type="text" id="reportrange" name="date" value="{{request()->date}}"
                                       placeholder="{{__('lang.reportrange')}}" class="form-control"/>
                            </div>

                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.orders.data') }}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="orders"
                               data-cookie="true"
                               data-cookie-id-table="orders"
                               data-show-footer="true"
                                >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="100" data-sortable="true">ID</th>
                                <th data-field="created_at">
                                    {{__('lang.date_created')}}
                                </th>

                                <th data-field="name">
                                    {{__('lang.user_created')}}
                                </th>

                                <th data-field="phone">
                                    {{__('lang.phone')}}
                                </th>

                                <th data-field="amount">
                                    {{__('lang.quantity')}}
                                </th>

                                <th data-field="total" data-footer-formatter="sumFormatter" data-type="number" data-formatter="numberFormatter">
                                    {{__('lang.total_money')}}
                                </th>

                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
                                    {{__('_action')}}
                                </th>

                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @stop
        @section('scripts')
            <link href="/lib/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet"
                  type="text/css"/>
            <link href="/lib/assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
            <link href="/lib/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
                  type="text/css"/>
            <script src="/lib/assets/libs/moment/moment.min.js"></script>
            <script src="/lib/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
            <script src="/lib/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
            <script src="/lib/assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>

            <script src="/lib/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <script src="/lib/assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>

            <!-- Init js-->
            <script src="{{asset('lib/assets/js/pages/form-pickers.init.js')}}"></script>

            <script>
                $(document).ready(function () {
                    $("select").on('change', function () {
                        $table.bootstrapTable('refresh');
                    });
                    $('input[name=date]').on('change',function(){
                        $table.bootstrapTable('refresh');
                    })
                });

                function statusFormatter(value, row) {

                    let html = '<div class="checkbox" >';
                    let public = null;
                    let status = null;

                    if (row.public == 1) {
                        public = "checked";
                    }

                    if (row.status == 1) {
                        status = "checked";
                    }

                    html += '<input id="checkbox_public_' + row.id + '" ' + public + ' type="checkbox" name="public">';
                    html += '<label for="checkbox_public_' + row.id + '" class="data_public" data-id="' + row.id + '">Hiển thị</label>';
                    html += '</div>';

                    html += '<div class="checkbox" >';
                    html += '<input id="checkbox_status_' + row.id + '" ' + status + ' type="checkbox" name="status">';
                    html += '<label for="checkbox_status_' + row.id + '" class="mb-0 data_status" data-id="' + row.id + '">Nổi bật</label>';
                    html += '</div>';

                    return html;
                }


                function actionFormatter(value, row) {

                    let html = '<a href="' + '{{ route('admin.orders.print', ':id') }}'.replace(':id', row.id) + '" class="ajax-modal btn btn-purple waves-effect waves-light"><i class="pe-7s-print"></i></a> ';
                    @can('order.destroy')
                    html += '<a href="' + '{{ route('admin.orders.destroy', ':id') }}'.replace(':id', row.id) + '" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
                    @endcan
                    return html;
                }

            </script>
@stop
