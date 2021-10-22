@extends('admin.layouts.layout')
@section('title')
    Thêm mới
@stop
@section('content')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.modules.index')}}">Modules Systems</a></li>
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
        <form method="post" action="{{route('admin.modules.store')}}" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-lg-4">
                    <div class="card-box">
                        <div class="form-group mb-0">
                            <label>Tên module <span class="required">*</span></label>
                            <p>* Không trùng với các module trước</p>
                            <input type="text" class="form-control" value="{{old('module')}}" id="module" name="module" required>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card-box">
                        <div class="form-group mb-0">
                            <label>Tên bảng <span class="required">*</span></label>
                            <p class="font-13">* Không trùng với các bảng trước</p>
                            <input type="text" class="form-control" value="{{old('table')}}" id="table" name="table" required>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card-box">
                        <div class="form-group mb-0">
                            <label>Số cột <span class="required">*</span></label>
                            <p class="font-13">* Dạng số và lớn hơn 0</p>
                            <input type="number" class="form-control" value="{{old('column')}}" min="1" id="column" name="column" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row" id="column_list">
                    </div>
                </div>
                <div class="col-lg-12">
                    <a href="{{route('admin.modules.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>
                    <button type="submit" class="btn btn-primary waves-effect width-md waves-light float-right" name="send" value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
                </div>

            </div>
            <!-- end row -->
        </form>
    </div>
@stop

@section('scripts')
    <script src="{{asset('lib/js/module/module_add.js')}}"></script>

    <script src="{{asset('lib/assets/libs/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="https://coderthemes.com/adminox/layouts/vertical/assets/libs/select2/select2.min.js"></script>
    <script src="{{asset('lib/assets/libs/jquery-mockjax/jquery.mockjax.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/autocomplete/jquery.autocomplete.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('lib/assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{asset('lib/assets/js/pages/form-advanced.init.js')}}"></script>

@stop

@section('styles')
    <link href="{{asset('lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />

    <!-- Summernote css -->
    <link href="{{asset('lib/assets/libs/summernote/summernote-bs4.css')}}" rel="stylesheet" type="text/css" />

@stop
