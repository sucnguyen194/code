@extends('admin.layouts.layout')
@section('title')
    Mã giảm giá #ID{{$discount->id}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.discounts.index')}}">Mã giảm giá</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Thêm mới</h4>
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
                        <label class="form-label required">Tên chương trình</label>
                        <input type="text" name="discount[name]" class="form-control" value="{{ $discount->name }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Code giảm giá</label>
                        <input type="text" name="discount[code]" class="form-control" value="{{ Str::upper($discount->code) }}" required>
                    </div>

                    <div class="form-group" style="max-width: 300px">
                        <label class="form-label required">Giá trị</label>

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
                    <label class="font-weight-bold mb-4">Sản phẩm</label>
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
                    <label class="font-weight-bold mb-4">Giới hạn</label>

                    <div class="form-group">
                        <label class="form-label">Tổng lần sử dụng</label>
                        <input type="number" name="discount[uses_total]" class="form-control" min="0" value="{{ $discount->uses_total }}" placeholder="Không giới hạn">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lần sử dụng mỗi người</label>
                        <input type="number" name="discount[uses_user]" class="form-control" min="0" value="{{ $discount->uses_user }}" placeholder="Không giới hạn">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label required">Thời gian bắt đầu</label>
                            <input type="text" name="discount[start_at]" class="form-control datetimepicker" value="{{ optional($discount->start_at)->format('d-m-Y H:i:s') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Thời gian kết thúc</label>
                            <input type="text" name="discount[end_at]" class="form-control datetimepicker" value="{{ optional($discount->end_at)->format('d-m-Y H:i:s')  }}" placeholder="Vĩnh viễn">
                        </div>
                    </div>

                </div>

                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">Điều kiện</label>

                    <div class="form-group">
                        <label class="form-label">Số lượng mua tối thiểu</label>
                        <input type="number" name="discount[minimum_quantity]" class="form-control" min="1" value="{{ $discount->minimum_quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Số tiền đơn tối thiểu (VND)</label>
                        <input type="number" name="discount[minimum_amount]" class="form-control" min="0" value="{{ $discount->minimum_amount }}">
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body pb-2">
                    <label class="font-weight-bold mb-4">Đối tượng khách hàng</label>

                    <div class="form-group">
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="all" checked>
                            <span class="custom-control-label">Tất cả khách hàng</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input name="discount[user_selection]" type="radio" class="custom-control-input" value="users" {{ checked($discount->user_selection, 'users') }}>
                            <span class="custom-control-label">Chọn khách hàng:</span>
                        </label>

                        <select class="custom-select select2" id="users" data-allow-clear="true" data-placeholder="Chọn khách hàng" data-multiple="true" multiple name="users[]" size="6">
                            @foreach($users as $users)
                                <option value="{{ $users->id }}" {{ selected($users->id, optional(optional($discount->users)->pluck('id'))->toArray()) }}>#{{ $users->id }} {{ $users->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <hr class="m-0">
                <div class="card-body pb-2">
                    <div class="form-group">
                        <label class="form-label">Mô tả thêm</label>
                        <textarea class="form-control" name="discount[description]" rows="3">{{ $discount->description }}</textarea>
                    </div>

                    <div class="form-group">

                        <label class="custom-control custom-checkbox">
                            <input type="hidden" name="discount[status]" value="0">
                            <input type="checkbox" class="custom-control-input" name="discount[status]" value="1" {{ checked($discount->status , \App\Enums\Activation::true()) }}>
                            <span class="custom-control-label">Active</span>
                        </label>

                        <label class="custom-control custom-checkbox d-none">
                            <input type="hidden" name="discount[public]" value="0">
                            <input type="checkbox" class="custom-control-input" name="discount[public]" value="1" {{ checked($discount->public, true) }}>
                            <span class="custom-control-label">Public</span>
                        </label>

                    </div>
                </div>


            </div>

            <div class="text-right mt-3">
                <a href="{{route('admin.discounts.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>

                <button type="submit" class="btn btn-primary float-right waves-effect width-md waves-light ml-2" name="send" value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
            </div>
        </form>
    </div>

@stop



@section('scripts')

    <script src="/lib/sources/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script type="text/javascript">

        $(function() {

            $('#services').bootstrapDualListbox({
                nonSelectedListLabel: 'Sản phẩm hiện có',
                selectedListLabel: 'Sản phẩm đã chọn',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false
            });

            $('#userss').bootstrapDualListbox({
                nonSelectedListLabel: 'Danh sách khách hàng',
                selectedListLabel: 'Khách hàng đã chọn',
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
            })

            $('input[name="discount[user_selection]"').trigger('change');
        });
    </script>
@endsection
