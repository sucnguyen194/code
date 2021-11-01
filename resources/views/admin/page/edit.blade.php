@extends('admin.layouts.layout')
@section('title')
    Page #ID{{$page->id}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.pages.index')}}">Page</a></li>
                            <li class="breadcrumb-item">#ID{{$page->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Page #ID{{$page->id}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- end page title -->
        <form method="post" action="{{route('admin.posts.update',$page)}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                @method('PATCH')
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
                                    <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link">
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

                                    <div class="">
                                        <label>Nội dung</label>
                                        <textarea class="form-control summernote" data-height="500" id="summerbody" name="translation[{{$key}}][content]">{!! $translation->content !!}</textarea>
                                    </div>
                                </div>

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

                        @if(setting('site.languages'))

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane" id="language-{{$language->value}}">
                                    <div class="card-box">
                                        <div class="form-group">
                                            <label>Tiêu đề <span class="required">*</span></label>
                                            <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][name]" >
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control summernote" data-height="200" id="summernote" name="translation[{{$key}}][description]"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Nội dung</label>
                                            <textarea class="form-control summernote" data-height="500" id="summerbody" name="translation[{{$key}}][content]"></textarea>
                                        </div>
                                    </div>

                                    <div class="card-box">
                                        <div class="d-flex mb-2">
                                            <label class="font-weight-bold">Tối ưu SEO</label>
                                            <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">Chỉnh sửa SEO</a>
                                        </div>

                                        <p class="font-13">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy trang trên công cụ tìm kiếm như Google.</p>
                                        <div class="test-seo">
                                            <div class="mb-1">
                                                <a href="javascript:void(0)" class="title-seo" id="title_seo_{{$language->value}}"></a>
                                            </div>
                                            <div class="url-se">
                                                <span class="slug-seo" id="{{$language->name}}">{{route('home')}}</span>
                                            </div>
                                            <div class="description-seo" id="description_seo_{{$language->value}}"></div>
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

                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-box">
                        <label class="font-15 mb-0">Trạng thái</label>
                        <hr>
                        <div class="checkbox">
                            <input id="checkbox_public" {{checked($page->public,1)}} type="checkbox" value="1" name="public">
                            <label for="checkbox_public">Hiển thị</label>
                        </div>

                        <div class="checkbox">
                            <input id="checkbox_status" {{checked($page->status,1)}} type="checkbox" value="1" name="status">
                            <label for="checkbox_status" class="mb-0">Nổi bật</label>
                        </div>
                    </div>

                    <div class="card-box position-relative box-action-image">
                        <label>Ảnh đại diện</label>
                        <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:2.2rem;top:1.3rem">
                            <label class="item-input">
                                <input type="file" id="image-upload" class="d-none image-upload" data-target="#image_url"> Chọn ảnh
                            </label>
                        </div>
                        <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif</p>
                        <div class="dropzone p-2 text-center">
                            <div class="dz-message text-center needsclick mb-1 {{$page->image ? "d-none" : ""}}" id="image_hidden">
                                <label for="image-upload" class="w-100 mb-0">
                                    <div class="icon-dropzone pt-2">
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    </div>
                                    <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span>
                                </label>
                            </div>
                            <img src="{{$page->image}}" alt="" class="rounded mb-1 {{!$page->image ? "d-none" : ""}}" id="image_src">
                            <div class="input-group">
                                <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                <input type="text" name="data[image]" placeholder="Đường dẫn ảnh" id="image_url" value="{{$page->image}}" class="form-control image-src" data-target="#image_src" data-hidden="#image_hidden">
                            </div>
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
                    <a href="{{route('admin.posts.index')}}" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại</a>
                    <button type="submit" class="btn btn-primary float-right waves-effect width-md waves-light" name="send" value="update"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
    <script>
        $('[data-toggle="tab"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('.tab-pane').removeClass('active').hide();
            $(pane).addClass('active').show();
        });
    </script>
@stop
