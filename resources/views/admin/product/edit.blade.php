@extends('admin.layouts.layout')
@section('title')
    Sản phẩm #ID{{$product->id}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Danh sách sản phẩm</a></li>
                            <li class="breadcrumb-item active">#ID{{$product->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sản phẩm #ID{{$product->id}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container" id="update-product">
        <form method="post" action="{{route('admin.products.update',$product)}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                @method('PUT')
                <div class="col-lg-8">
                    @if(setting('site.languages'))
                        <ul class="nav nav-tabs tabs-bordered nav-justified pt-1 bg-white">
                            @foreach($translations as $key => $translation)
                                <li class="nav-item">
                                    <a href=".language-{{$translation->locale}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$key == 0 ? 'active' : null}}">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                        <span class="d-none d-sm-block">{{$translation->language->name}}</span>
                                    </a>
                                </li>
                            @endforeach

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <li class="nav-item">
                                    <a href=".language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                        <span class="d-none d-sm-block">{{$language->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                        <div class="tab-content pt-0">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}} {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                <div class="card-box">
                                    <div class="form-group">
                                        <label>Tiêu đề <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="translation[{{$key}}][name]" value="{{$translation->name}}" >
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control summernote" data-height="200" id="summernote" name="translation[{{$key}}][description]">{!! $translation->description !!}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control summernote" data-height="500" id="summerbody" name="translation[{{$key}}][content]">{!! $translation->description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                    <div class="card-box">
                                        <div class="form-group">
                                            <label>Tiêu đề <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="translation[{{$key}}][name]" value="" >
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control summernote" data-height="200" id="summernote" name="translation[{{$key}}][description]"></textarea>
                                        </div>

                                        <div class="">
                                            <label>Nội dung</label>
                                            <textarea class="form-control summernote" data-height="500" id="summerbody" name="translation[{{$key}}][content]"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-lg-0 mb-sm-0 mb-md-0">
                                        <label>Mã sản phẩm</label>
                                        <input type="text" class="form-control" value="{{$product->code}}" id="code" name="data[code]">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-lg-0 mb-sm-0 mb-md-0">
                                        <label>Giá bán: <span id="format-price" class="text-success">{{number_format($product->price)}}</span></label>
                                        <input type="text" class="form-control" min="0" value="{{$product->price}}" id="price" name="data[price]">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label>Giá KM: <span id="format-price-sale" class="text-success">{{number_format($product->price_sale)}}</span></label>
                                        <input type="text" class="form-control" value="{{$product->price_sale}}" min="0" id="price_sale" name="data[price_sale]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card-box position-relative box-action-image">
                        <label>Hình ảnh</label>
                        <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:2.2rem;top:1.3rem">
                            <label class="item-input">
                                <input type="file" class="d-none" id="slider-file" data-target="#slide-input" multiple> Chọn ảnh
                            </label>
                        </div>
                        <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif</p>
                        <div class="dropzone pl-2 pr-2 pb-1 ">
                            <div class="dz-message text-center needsclick mb-1 {{$product->photo ? "d-none" : "d-block"}}" id="remove-label">
                                <label for="slider-file" class="w-100 mb-0">
                                    <div class="icon-dropzone pt-2">
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    </div>
                                    <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span><br>
                                    <span class="text-muted font-13">Có thể upload <strong>Nhiều</strong> hình ảnh</span>
                                </label>
                            </div>
                            <ul class="slider-holder pl-0 mb-0 w-100 ui-sortable" id="sortable">
                                @if($product->photo)
                                @foreach($product->photo as $photo)
                                    <li class="box-product-images ui-sortable-handle d-inline-block">
                                        <div class="item-image rounded position-relative">
                                            <div class="img-rounded"><img src="{{$photo}}" class="position-image-product"/></div>
                                            <div class="photo-hover-overlay rounded">
                                                <input name="photos[]" type="hidden" value="{{$photo}}">
                                                <div class="box-hover-overlay">
                                                    <a title="Xem hình ảnh" data-image="{{$photo}}" data-toggle="modal" data-target="#viewImage" class="tooltip-hover view-image text-white">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                    {{--                                                <a class="tooltip-hover pl-2 text-white" v-on:click="getAlt(item.id)" data-target="#updateALT" data-toggle="modal" title="Sửa ALT">--}}
                                                    {{--                                                    ALT--}}
                                                    {{--                                                </a>--}}
                                                    <a class="tooltip-hover pl-2 text-white" id="slider-delete" title="Xóa hình ảnh">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content pt-0">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}}  {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                    <div class="card-box">
                                        <div class="d-flex mb-2">
                                            <label class="font-weight-bold">Tối ưu SEO</label>
                                            <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">Chỉnh sửa SEO</a>
                                        </div>

                                        <p class="font-13">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy trang trên công cụ tìm kiếm như Google.</p>
                                        <div class="test-seo">
                                            <div class="mb-1">
                                                <a href="javascript:void(0)" class="title-seo" id="title_seo_{{$translation->locale}}">{{$translation->title_seo}}</a>
                                            </div>
                                            <div class="url-se">
                                                <span class="slug-seo" id="{{$translation->language->name}}">{{route('slug', $translation->slug)}}</span>
                                            </div>
                                            <div class="description-seo" id="description_seo_{{$translation->locale}}">{{$translation->description_seo}}</div>
                                        </div>
                                        <div class="change-seo" id="change-seo">
                                            <hr>
                                            <div class="form-group">
                                                <label>Tiêu đề trang</label>
                                                <p class="font-13">* Ghi chú: Giới hạn tối đa 70 ký tự</p>
                                                <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" value="{{$translation->title_seo}}" language="title_seo_{{$translation->locale}}" onkeyup="changeToTitleSeo(this)" />
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả trang</label>
                                                <p class="font-13">* Ghi chú: Giới hạn tối đa 320 ký tự</p>
                                                <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$translation->locale}}" onkeyup="changeToDescriptionSeo(this)">{{$translation->description_seo}}</textarea>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label>Đường dẫn <span class="required">*</span></label>
                                                <div class="d-flex form-control">
                                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{$translation->language->name}}" onkeyup="ChangeToSlug(this);"name="translation[{{$key}}][slug]">
                                                    <span>.html</span>
                                                </div>
                                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        @endforeach
                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} " id="language-{{$language->value}}">
                                    {{--                                        <div class="card-box">--}}
                                    {{--                                            <label>Thuộc tính sản phẩm</label>--}}
                                    {{--                                            <table data-dynamicrows class="table table-bordered table-striped mb-0">--}}
                                    {{--                                                <thead>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>Tên thuộc tính</th>--}}
                                    {{--                                                    <th>Giá trị</th>--}}
                                    {{--                                                    <th>Hành động</th>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                </thead>--}}
                                    {{--                                                <tbody>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <td><input type="text" name="fields[0][name]" class="form-control"></td>--}}
                                    {{--                                                    <td><input type="text" name="fields[0][value]" class="form-control"></td>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        <i class="fas fa-minus" data-remove></i>--}}
                                    {{--                                                        <i class="fas fa-arrows-alt" data-move></i>--}}
                                    {{--                                                        <i class="fas fa-plus" data-add></i>--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                </tbody>--}}
                                    {{--                                            </table>--}}
                                    {{--                                        </div>--}}
                                    <div class="card-box">
                                        <div class="d-flex mb-2">
                                            <label class="font-weight-bold">Tối ưu SEO</label>
                                            <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">Chỉnh sửa SEO</a>
                                        </div>

                                        <p class="font-13">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy trang trên công cụ tìm kiếm như Google.</p>
                                        <div class="test-seo">
                                            <div class="mb-1">
                                                <a href="javascript:void(0)" class="title-seo" id="title_seo_{{$translation->locale}}">{{$translation->title_seo}}</a>
                                            </div>
                                            <div class="url-se">
                                                <span class="slug-seo" id="{{$translation->language->name}}">{{route('slug', $translation->slug)}}</span>
                                            </div>
                                            <div class="description-seo" id="description_seo_{{$translation->locale}}">{{$translation->description_seo}}</div>
                                        </div>
                                        <div class="change-seo" id="change-seo">
                                            <hr>
                                            <div class="form-group">
                                                <label>Tiêu đề trang</label>
                                                <p class="font-13">* Ghi chú: Giới hạn tối đa 70 ký tự</p>
                                                <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)" />
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả trang</label>
                                                <p class="font-13">* Ghi chú: Giới hạn tối đa 320 ký tự</p>
                                                <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Đường dẫn <span class="required">*</span></label>
                                                <div class="d-flex form-control">
                                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
                                                    <span>.html</span>
                                                </div>
                                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>


                    @if($attributes->count())
{{--                        <div class="card-box clearfix">--}}
{{--                            <label class="mb-0">Thuộc tính</label>--}}
{{--                            <hr>--}}

{{--                            <div class="row">--}}
{{--                                @foreach($attributes as $attribute)--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <div class="checkbox">--}}
{{--                                            <input type="checkbox" value="{{$attribute->id}}" class="radio-blue" {{checked($attribute->id, $product->cate_attributes->pluck('id')->toArray())}} name="cate_attribute[]" id="attribute_{{$attribute->id}}">--}}
{{--                                            <label for="attribute_{{$attribute->id}}">{{$attribute->translation->name}}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}

{{--                        </div>--}}
                    @endif
                    {{--                    <div class="card-box clearfix">--}}
                    {{--                        <label>Thuộc tính sản phẩm</label>--}}
                    {{--                        <table data-dynamicrows class="table table-bordered table-striped mb-0">--}}
                    {{--                            <thead>--}}
                    {{--                            <tr>--}}
                    {{--                                <th>Tên thuộc tính</th>--}}
                    {{--                                <th>Giá trị</th>--}}
                    {{--                                <th>Hành động</th>--}}
                    {{--                            </tr>--}}
                    {{--                            </thead>--}}
                    {{--                            <tbody>--}}

                    {{--                            @if($product->options)--}}

                    {{--                                @foreach($product->options as $key => $item)--}}
                    {{--                                    <tr>--}}
                    {{--                                        <td><input type="text" name="fields[{{$key}}][name]" value="{{$item['name']}}" class="form-control"></td>--}}
                    {{--                                        <td><input type="text" name="fields[{{$key}}][value]" value="{{$item['value']}}" class="form-control"></td>--}}
                    {{--                                        <td>--}}
                    {{--                                            <i class="fas fa-minus" data-remove></i>--}}
                    {{--                                            <i class="fas fa-arrows-alt" data-move></i>--}}
                    {{--                                            <i class="fas fa-plus" data-add></i>--}}
                    {{--                                        </td>--}}
                    {{--                                    </tr>--}}
                    {{--                                @endforeach--}}
                    {{--                            @else--}}
                    {{--                                <tr>--}}
                    {{--                                    <td><input type="text" name="fields[0][name]"  class="form-control"></td>--}}
                    {{--                                    <td><input type="text" name="fields[0][value]" class="form-control"></td>--}}
                    {{--                                    <td>--}}
                    {{--                                        <i class="fas fa-minus" data-remove></i>--}}
                    {{--                                        <i class="fas fa-arrows-alt" data-move></i>--}}
                    {{--                                        <i class="fas fa-plus" data-add></i>--}}
                    {{--                                    </td>--}}
                    {{--                                </tr>--}}
                    {{--                            @endif--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                    {{--                    </div>--}}

                </div>
                <div class="col-lg-4">
                    <div class="card-box">
                        <label class="mb-0">Trạng thái</label>
                        <hr>
                        <div class="checkbox">
                            <input id="checkbox_public" {{checked($product->public,1)}} type="checkbox" name="public" value="1">
                            <label for="checkbox_public">Hiển thị</label>
                        </div>

                        <div class="checkbox">
                            <input id="checkbox_status" type="checkbox" {{checked($product->status,1)}} name="status" value="1">
                            <label for="checkbox_status" class="mb-0">Nổi bật</label>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="form-group mb-0">
                            <label>Danh mục chính</label>
                            <select class="form-control" data-toggle="select2" name="data[category_id]">
                                <option value="0">Chọn danh mục</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}" {{selected($item->id, $product->category_id)}} class="font-weight-bold">{{$item->translation->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="form-group mb-0">
                            <label>Danh mục phụ</label>
                            <p class="font-13">* Chọn được nhiều danh mục</p>
                            <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="category_id[]" data-placeholder="Chọn danh mục phụ">
                                @foreach($categories as $item )
                                    <option value="{{$item->id}}" {{selected($item->id,$product->categories->pluck('id')->toArray())}} class="font-weight-bold">{{$item->translation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="tab-content pt-0">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}}  {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                <div class="card-box">
                                    <div class="form-group mb-0">
                                        <label>Tag</label>
                                        <p class="font-13">* Ghi chú: Từ khóa được phân chia sau dấu phẩy <strong>","</strong></p>

                                        <input type="text" name="translation[{{$key}}][tag]" value="{!! $translation->tag !!}" class="form-control"  data-role="tagsinput" placeholder="add tags"/>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}}" id="language-{{$language->value}}">
                                    <div class="card-box">
                                        <div class="form-group mb-0">
                                            <label>Tag</label>
                                            <p class="font-13">* Ghi chú: Từ khóa được phân chia sau dấu phẩy <strong>","</strong></p>

                                            <input type="text" name="translation[{{$key}}][tag]" value="" class="form-control"  data-role="tagsinput" placeholder="add tags"/>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>

                <div class="col-lg-12">
                    <a href="{{route('admin.products.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>
                    <button type="submit" class="btn btn-primary waves-effect width-md waves-light float-right" name="send" value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>

    <div id="viewImage" class="modal fade" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <img src="" class="img-fluid showImage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> Đóng</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).on('click','.view-image',function(){
            let image = $(this).attr('data-image');
            $('.showImage').attr('src', image);
        })
        $('[data-toggle="tab"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('.tab-pane').removeClass('active').hide();
            $(pane).addClass('active').show();
        });

        let price = document.getElementById('price');
        let sale = document.getElementById('price_sale');
        let format_price = document.getElementById('format-price');
        let format_price_sale = document.getElementById('format-price-sale');

        $(price).on('keyup',function (){
            let value = $(this).val();
            $(format_price).text(number_format(value));
        })

        $(sale).on('keyup',function (){
            let value = $(this).val();
            $(format_price_sale).text(number_format(value));
        })
    </script>
@stop

@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/lib/assets/js/pages/form-advanced.init.js"></script>
    <script src="/lib/js/dynamicrows/dynamicrows.js"></script>
    <script>
        $('[data-dynamicrows]').dynamicrows();
        $( "#sortable" ).sortable();
    </script>
@stop
