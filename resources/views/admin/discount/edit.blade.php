@extends('admin.layouts.layout')
@section('title')
    {{__('lang.discount')}} #{{$discount->id}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.discounts.index')}}">{{__('lang.discount')}}</a></li>
                            <li class="breadcrumb-item active">#{{$discount->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.discount')}} #{{$discount->id}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container">
        <form method="POST" action="{{ route('admin.discounts.update',$discount) }}" class="ajax-form">
            @csrf
            @method('PUT')
            <div class="card">

                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label">{{__('lang.discount_name')}} <span class="required">*</span> </label>
                        <input type="text" name="discount[name]" class="form-control" value="{{ $discount->name }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.code')}} <span class="required">*</span></label>
                        <input type="text" name="discount[code]" class="form-control" value="{{ Str::upper($discount->code) }}" required>
                    </div>

                    <div class="form-group" style="max-width: 300px">
                        <label class="form-label">{{__('lang.value')}} <span class="required">*</span></label>

                        <div class="input-group discount">
                            <input type="number" name="discount[value]" step="0.01" min="0" class="form-control"  value="{{ $discount->value }}" required>
                            <div class="input-group-prepend" style="width: 100px;height: 33.59px;margin-left: -1px">
                                <select class="custom-select" name="discount[value_type]" >
                                    <option value="0">%</option>
                                    <option value="1" {{ selected($discount->value_type, 1) }}>VND</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.product')}}</label>
                    <div class="form-group duallistbox-hidden-select">
                        <select class="custom-select" id="services" multiple name="products[]" size="10" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ selected($product->id, optional(optional($discount->products)->pluck('id'))->toArray()) }}> {{ optional($product->translation)->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.limit')}}</label>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.total_usage')}}</label>
                        <input type="number" name="discount[uses_total]" class="form-control" min="0" value="{{ $discount->uses_total }}" placeholder="{{__('lang.unlimit')}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.usage_per_person')}}</label>
                        <input type="number" name="discount[uses_user]" class="form-control" min="0" value="{{ $discount->uses_user }}" placeholder="{{__('lang.unlimit')}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('lang.start_time')}} <span class="required">*</span></label>
                            <input type="text" name="discount[start_at]" class="form-control datetimepicker" value="{{ optional($discount->start_at)->format('d-m-Y H:i:s') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">{{__('lang.end_time')}}</label>
                            <input type="text" name="discount[end_at]" class="form-control datetimepicker" value="{{ optional($discount->end_at)->format('d-m-Y H:i:s')  }}" placeholder="{{__('lang.unlimit')}}">
                        </div>
                    </div>

                </div>

                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.condition')}}</label>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.minimum_purchase_quantity')}}</label>
                        <input type="number" name="discount[minimum_quantity]" class="form-control" min="1" value="{{ $discount->minimum_quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{__('lang.minimum_order_amount')}}</label>
                        <input type="number" name="discount[minimum_amount]" class="form-control" min="0" value="{{ $discount->minimum_amount }}">
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">{{__('lang.customers')}}</label>

                    <div class="form-group">
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="all" checked>
                            <span class="custom-control-label">{{__('lang.all_customers')}}</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="users" {{ checked($discount->user_selection, 'users') }}>
                            <span class="custom-control-label">{{__('lang.choose_customer')}}</span>
                        </label>

                        <select class="custom-select select2" id="users" data-allow-clear="true" data-placeholder="{{__('lang.choose_customer')}}" data-multiple="true" multiple name="users[]" size="6">
                            @foreach($users as $users)
                                <option value="{{ $users->id }}" {{ selected($users->id, optional(optional($discount->users)->pluck('id'))->toArray()) }}>#{{ $users->id }} {{ $users->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <hr class="m-0">
                <div class="card-body pb-2">
                    <div class="form-group">
                        <label class="form-label">{{__('lang.description')}}</label>
                        <textarea class="form-control" name="discount[description]" rows="3">{{ $discount->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <input type="hidden" name="discount[status]" value="0">
                            <input id="checkbox_status" type="checkbox" name="discount[status]" value="1" {{ checked($discount->status , \App\Enums\Activation::true()) }}>
                            <label for="checkbox_status" class="mb-0">{{__('lang.active')}}</label>
                        </div>

                        <div class="checkbox d-none">
                            <input type="hidden" name="discount[public]" value="0">
                            <input id="checkbox_public" type="checkbox" name="discount[public]" value="1" {{ checked($discount->public, true) }}>
                            <label for="checkbox_public" class="mb-0">{{__('lang.public')}}</label>
                        </div>
                    </div>
                </div>


            </div>

            <div class="text-right mt-3">
                @include('admin.render.button', ['route' => route('admin.discounts.index')])
            </div>
        </form>
    </div>

@stop



@section('scripts')

    <script src="/lib/sources/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script type="text/javascript">

        $(function() {

            $('#services').bootstrapDualListbox({
                nonSelectedListLabel: '{{__('lang.existing_products')}}',
                selectedListLabel: '{{__('lang.selected_products')}}',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false
            });

            $('#userss').bootstrapDualListbox({
                nonSelectedListLabel: '{{__('lang.list_customers')}}',
                selectedListLabel: '{{__('lang.selected_customers')}}',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false
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
