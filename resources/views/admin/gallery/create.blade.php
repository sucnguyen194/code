<div class="modal-dialog modal-lg" style="max-width: 800px!important" role="document">
    <form action="{{route('admin.products.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(setting('site.languages'))
                    <ul class="nav nav-tabs tabs-bordered nav-justified bg-white" style="margin-bottom: 20px">
                        @foreach(languages() as $key => $language)
                            <li class="nav-item">
                                <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false"
                                   class="nav-link {{$key == 0 ? 'active' : null}}">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">{{$language->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="tab-content pt-0">
                    <div class="form-group position-relative box-action-image">
                        <label>Hình ảnh</label>
                        <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:0;top:0">
                            <label class="item-input mb-0">
                                <input type="file" class="d-none" id="slider-file" data-target="#slide-input" multiple> Chọn ảnh
                            </label>
                        </div>
                        <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif</p>
                        <div class="dropzone pl-2 pr-2 pb-1">
                            <div class="dz-message text-center needsclick mb-1" id="remove-label">
                                <label for="slider-file" class="w-100 mb-0">
                                    <div class="icon-dropzone pt-2">
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    </div>
                                    <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span><br>
                                    <span class="text-muted font-13">Có thể upload <strong>Nhiều</strong> hình ảnh</span>

                                </label>
                            </div>

                            <ul class="slider-holder d-none pl-0 mb-0 w-100" id="sortable">

                            </ul>
                        </div>
                    </div>

                    @foreach(languages() as $key => $language)
                        <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                            <div class="form-group">
                                <label>Tiêu đề <span class="required">*</span></label>
                                <input type="text" class="form-control" language="{{$language->value}}"
                                       seo="{{$language->name}}" onkeyup="ChangeToSlug(this);"
                                       name="translation[{{$key}}][name]">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control summerdescription" data-height="200" id="summernote" name="translation[{{$key}}][description]"></textarea>
                            </div>

                            <div class="form-group">
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
                                        <p class="font-13">* Giới hạn tối đa 70 ký tự</p>
                                        <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả trang</label>
                                        <p class="font-13">* Giới hạn tối đa 320 ký tự</p>
                                        <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa</label>
                                        <p class="font-13">* Từ khóa được phân chia sau dấu phẩy <strong>","</strong></p>

                                        <input type="text" name="translation[{{$key}}][tag]" value="" class="form-control"  data-role="tagsinput" placeholder="add tags"/>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal"
                        aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>
                <input type="hidden" name="data[type]" value="{{\App\Enums\ProductType::gallery}}">
                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại
                </button>
            </div>
        </div>
    </form>
</div>
<div id="viewImage" class="modal fade modal-gallery" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hình ảnh</h5>
                <button type="button" class="close" onclick="jQuery('.modal-gallery').modal('hide');" data-dismiss="modal-gallery" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid showImage">
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> Đóng</button>--}}
{{--            </div>--}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    #ajax-modal {
        overflow-y: scroll;
    }
</style>
<link href="/lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<script src="/lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="/lib/js/cpanel.js"></script>
<script>
    $(document).on('click','.view-image',function(){
        let image = $(this).attr('data-image');
        $('.showImage').attr('src', image);
    })
</script>
<script type="text/javascript">
    $( "#sortable" ).sortable();
</script>
<script type="text/javascript">
    $('#slider-file').on('change', function () {

        let count = $(this)[0].files.length;
        let slider = $('.slider-holder');

        for(var i=0 ; i < count ; i++){
            let file = $(this).prop('files')[i];
            if (!file)
                return false;

            let formData = new FormData();
            formData.append('image', file);
            $('.loading').fadeIn();
            fetch(
                "https://api.imgur.com/3/image",
                {
                    method: "POST",
                    body: formData,
                    "headers": {
                        "Authorization": "Client-ID {{ setting('api.imgur_client_id') }}"
                    },
                }
            )
                .then(response => response.json())
                .then(result => {
                    $(slider).removeClass('d-none').addClass('d-inline-block');

                    $('<li class="box-product-images">' +
                        '<div class="item-image position-relative">' +
                        '<div class="img-rounded"><img src="'+result.data.link+'" class="position-image-product"/></div>' +
                        '<input name="photos[]" type="hidden" value="'+ result.data.link +'">' +
                        '<div class="photo-hover-overlay">' +
                        '<div class="box-hover-overlay">' +
                        '<a class="tooltip-hover view-image text-white" data-image="'+result.data.link+'" data-toggle="modal" data-target="#viewImage" title="Xem hình ảnh">' +
                        '<i class="far fa-eye"></i>' +
                        '</a>' +
                        '<a class="pl-2 tooltip-hover text-white" id="slider-delete" title="Xóa hình ảnh">' +
                        '<i class="far fa-trash-alt"></i>' +
                        '</a>' +
                        '</div> '+
                        '</div>' +
                        '</div>' +
                        '</li>').appendTo(slider);
                    $('#remove-label').removeClass('d-block').hide();
                    $('.loading').fadeOut();
                })
                .catch(error => {
                    $('#remove-label').show();
                    $(slider).addClass('d-none');
                        var obj  = {
                            'message': 'Lỗi upload: '+error,
                            'type' :'error'
                        };
                     flash(obj);
                    //console.error("Error:", error);
                });
        }

    });

    $(document).on('click','#slider-delete',function(){
        let slider = document.getElementsByClassName('slider-holder');
        let remove = document.getElementById('remove-label');
        $(this).parent().parent().parent().parent().remove();

        if($(slider).children().length == 0){
            $(slider).addClass('d-none').removeClass('d-inline-block');
            $(remove).removeClass('d-none').show();
        }
    })
    $(document).on('change','#slider-input',function(){

        let parent = $(this).parent().parent().parent().parent();

        $(parent).find('div > img').attr('src', $(this).val());
    })


    $('.logo-upload, .og-upload, .favicon-upload, .image-upload, .background-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': 'API IMG chưa được cấu hình!', 'type': 'error'});

        let target = $(this).data('target');

        let formData = new FormData();
        formData.append('image', file);
        $('.loading').fadeIn();
        fetch(
            "https://api.imgur.com/3/image",
            {
                method: "POST",
                body: formData,
                "headers": {
                    "Authorization": "Client-ID "+ imgur_client_id
                },
            }
        )
            .then(response => response.json())
            .then(result => {
                $(target).val(result.data.link).trigger('change');
                $('.loading').fadeOut();
            })
            .catch(error => {
                alert('Lỗi upload: '+error)
                console.error("Error:", error);
            });

    });

    $('.logo-src, .og-src, .favicon-src, .image-src, .background-src').on('change', function (){

        let target = $(this).data('target');
        let  hidden = $(this).data('hidden');
        if ($(this).val()){
            $(target).removeClass('d-none').attr('src', $(this).val()).show();
            $(hidden).hide();
        }else{
            $(target).hide();
            $(hidden).removeClass('d-none').show();
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })

</script>
<script src="/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var links = "{{route('home')}}";

    $(document).ready(function(){
        tinymce.init({
            language : 'vi',
            plugins: "wordcount textcolor image  link  anchor   charmap media   lists responsivefilemanager",
            toolbar: [
                'fontsizeselect | bold italic underline strikethrough  | alignleft aligncenter alignright alignjustify | removeformat',

            ],
            height : "150",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            // content_css: [
            //     '/public/css/app.css'
            // ],
            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],
            relative_urls: false,
            selector: ".summerdescription",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links+"/lib/filemanager/",
            external_plugins: {"filemanager": links+"/lib/filemanager/plugin.min.js"}
        });

    });
</script>
