@extends('admin.layouts.layout')
@section('title')
    {{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_discount'))}}
@stop
@section('content')
    <style>
        .discount .select2-container .select2-selection--single {
            height: 35.59px!important;
            margin-left: -1px;
            border-top-left-radius:0 ;
            border-bottom-left-radius: 0;
        }
        .duallistbox-hidden-select .select2 {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="/lib/sources/bootstrap-duallistbox/bootstrap-duallistbox.css">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.discounts.index')}}">{{__('_discount')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_discount'))}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_discount'))}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container">
        <form method="POST" action="{{ route('admin.discounts.store') }}" class="ajax-form">
            @csrf
            <div class="card">

                <div class="card-body pb-2">

                    <div class="form-group">
                        <label class="form-label">{{__('_discount_name')}} <span class="required">*</span> </label>
                        <input type="text" name="discount[name]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.code')}} <span class="required">*</span></label>
                        <input type="text" name="discount[code]" class="form-control" value="{{ Str::upper(Str::random(10)) }}" required>
                    </div>

                    <div class="form-group" style="max-width: 300px">
                        <label class="form-label">{{__('_value')}} <span class="required">*</span></label>

                        <div class="input-group discount">
                            <input type="number" name="discount[value]" step="0.01" min="0" class="form-control" required>
                            <div class="input-group-prepend" style="width: 100px;height: 33.59px;margin-left: -1px">
                                <select class="custom-select" name="discount[value_type]" >
                                    <option value="0">%</option>
                                    <option value="1">VND</option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('_product')}}</label>
                    <div class="form-group duallistbox-hidden-select">
                        <select class="custom-select duallistbox d-none" multiple name="products[]" size="10" required style="display: none">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"> {{ optional($product->translation)->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.limit')}}</label>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.total_usage')}}</label>
                        <input type="number" name="discount[uses_total]" class="form-control" min="0" value="1" placeholder="{{__('lang.unlimit')}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.usage_per_person')}}</label>
                        <input type="number" name="discount[uses_user]" class="form-control" min="0" value="1" placeholder="{{__('lang.unlimit')}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('lang.start_time')}} <span class="required">*</span></label>
                            <input type="text" name="discount[start_at]" class="form-control datetimepicker" value="{{ now()->format('d-m-Y 00:00:00') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('lang.end_time')}}</label>
                            <input type="text" name="discount[end_at]" class="form-control datetimepicker" placeholder="{{__('lang.unlimit')}}">
                        </div>
                    </div>

                </div>


                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.condition')}}</label>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.minimum_purchase_quantity')}}</label>
                        <input type="number" name="discount[minimum_quantity]" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.minimum_order_amount')}}</label>
                        <input type="number" name="discount[minimum_amount]" class="form-control" min="0" value="1">
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('_customers')}}</label>

                    <div class="form-group">
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="all" checked>
                            <span class="custom-control-label">{{__('lang.all_customers')}}</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="users">
                            <span class="custom-control-label">{{__('lang.choose_customer')}}</span>
                        </label>

                        <select class="custom-select select2" id="users" data-allow-clear="true" data-placeholder="{{__('lang.choose_customer')}}" data-multiple="true" multiple name="users[]" size="6">
                            @foreach($users as $users)
                                <option value="{{ $users->id }}">#{{ $users->id }} {{ $users->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <div class="form-group">
                        <label class="form-label">{{__('_description')}}</label>
                        <textarea class="form-control" name="discount[description]" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <input id="checkbox_status" type="checkbox" name="discount[status]" value="1" checked>
                            <label for="checkbox_status" class="mb-0">{{__('lang.active')}}</label>
                        </div>

                        <div class="checkbox d-none">
                            <input id="checkbox_public" type="checkbox" name="discount[public]" value="1">
                            <label for="checkbox_public" class="mb-0">{{__('lang.public')}}</label>
                        </div>
                    </div>
                </div>


            </div>

            <div class="mt-3">
                @include('admin.render.button', ['route' => route('admin.discounts.index')])
            </div>

        </form>
    </div>

@stop



@section('scripts')

    <script src="/lib/sources/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script type="text/javascript">

        $(function() {

            $('.duallistbox').bootstrapDualListbox({
                nonSelectedListLabel: '{{__('lang.existing_products')}}',
                selectedListLabel: '{{__('lang.selected_products')}}',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                helperSelectNamePostfix: false
            });

            $('input[name="discount[user_selection]"').on('change', function(){

                if ($('input:checked[name="discount[user_selection]"').val() == 'all'){
                    $('#users').attr('disabled', true);
                    $('#users').attr('required', false);
                }else{
                    $('#users').attr('disabled', false);
                    $('#users').attr('required', true);
                }
            });

            $('input[name="discount[user_selection]"').trigger('change');
        });
	</script>
@endsection
