@extends('admin.layouts.layout')
@section('title') {{__('_filter')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_filter')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_filter')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('product.create')
                        <a href="{{route('admin.attributes.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_filter'))}}</a>
                        @endcan
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.attributes.data') }}"
                               data-side-pagination="server"
                               data-pagination="false"
                               data-search="false"
                               data-show-refresh="false"
                               data-show-columns="false"
                               data-show-export="false"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="sort"
                               data-sort-order="asc"
                               data-filename="categories"
                               data-cookie="true"
                               data-cookie-id-table="categories"
                               data-tree-show-field="name"
                               data-parent-id-field="category_id"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="100" data-sortable="true" data-visible="true">ID</th>
                                <th data-formatter="sortFormatter" data-width="100">{{__('_sort')}}</th>
                                <th data-field="name" data-formatter="titleFormatter">
                                    {{__('_title')}}
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
        <!-- end row -->
    </div>
    <input type="hidden" class="type" value="{{\App\Enums\AttributeType::attribute}}">
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        });

        $(document).on('post-body.bs.table', function() {
            var columns = $table.bootstrapTable('getOptions').columns;
            if (columns && columns[0][1].visible) {

                $table.treegrid({
                    treeColumn: 2,
                    onChange: function() {
                        $table.bootstrapTable('resetView')
                    }
                })
            }
        });
        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function titleFormatter(value, row){
            if(!value)
                return ;
            return '<a href="#" class="font-weight-bold" target="_blank">'+value +'</a>';
        }

        function actionFormatter(value, row){

            let html = '';
            @can('product.edit')
                html += '<a href="'+ '{{ route('admin.attributes.edit', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan

                @can('product.destroy')
                html+='<a href="'+ '{{ route('admin.attributes.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
                return html;
        }

    </script>

@stop
