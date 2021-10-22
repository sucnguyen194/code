<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.categories.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
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
                                <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$key == 0 ? 'active' : null}}">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">{{$language->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="tab-content pt-0">
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                            <div class="form-group">
                                <label>Tiêu đề <span class="required">*</span></label>
                                <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][name]" >
                            </div>
                            <div class="form-group">
                                <label>Đường dẫn <span class="required">*</span></label>
                                <div class="d-flex form-control">
                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
                                    <span>.html</span>
                                </div>
                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                            </div>
                        </div>
                    @endforeach
                </div>

                    <div class="form-group">
                        <label>Danh mục cha</label>
                        <select class="form-control" data-toggle="select2" name="data[parent_id]">
                            <option value="0">Chọn danh mục</option>
                            @foreach($categories as $item )
                                <option value="{{$item->id}}" class="font-weight-bold">{{$item->translation->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Vị trí</label>
                        <select class="form-control" data-toggle="select2" name="data[position]">
                            <option value="0">Chọn ví trí</option>
                            <option value="1" {{old('data.position') == 1 ? "selected" : ""}}>Vị trí số 1</option>
                            <option value="2" {{old('data.position') == 2 ? "selected" : ""}}>Vị trí số 2</option>
                            <option value="3" {{old('data.position') == 3 ? "selected" : ""}}>Vị trí số 3</option>
                            <option value="4" {{old('data.position') == 4 ? "selected" : ""}}>Vị trí số 4</option>
                            <option value="5" {{old('data.position') == 5 ? "selected" : ""}}>Vị trí số 5</option>
                            <option value="6" {{old('data.position') == 6 ? "selected" : ""}}>Vị trí số 6</option>
                            <option value="7" {{old('data.position') == 7 ? "selected" : ""}}>Vị trí số 7</option>
                            <option value="8" {{old('data.position') == 8 ? "selected" : ""}}>Vị trí số 8</option>
                            <option value="9" {{old('data.position') == 9 ? "selected" : ""}}>Vị trí số 9</option>

                        </select>
                    </div>

                <div class="form-group position-relative">
                    <div class="media">
                        <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
                            <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
                                <img src="" class="image_src d-none" id="image_src" width="100%" height="100%">
                            </div>
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="data[image]" id="image_url" data-target="#image_src"  type="text" class="form-control" placeholder="http://">
                                    <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >Upload..</label>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="form-group position-relative">--}}
{{--                        <div class="media">--}}
{{--                            <div class="thumbnail-container square" style="border: 1px dashed #ddd;">--}}
{{--                                <div style="width: 100px; height: 100px; border: 1px solid #ddd;">--}}
{{--                                    <img src="" class="background_url d-none" id="background_url" width="100%" height="100%">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <label class="form-label">Ảnh nền</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input name="data[background]" id="background_url" data-target="#background_src"  type="text" class="form-control" placeholder="http://">--}}
{{--                                        <span class="input-group-append">--}}
{{--                                 <label class="btn btn-default" type="button"><input type="file" class="d-none background-upload" id="background-upload" data-target="#background_url" >Upload..</label>--}}
{{--                            </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <input type="hidden" name="data[type]" value="{{\App\Enums\CategoryType::post}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>

                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại
                </button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#image-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let target = $(this).data('target');

        let formData = new FormData();
        formData.append('image', file);
        $('.loading').fadeIn()
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
                $(target).val(result.data.link).trigger('change');
                $('.loading').fadeOut();
            })
            .catch(error => {
                alert('Lỗi upload: '+error)
                console.error("Error:", error);
            });

    });

    $('#image_url').on('change', function (){
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
        let editor = $('.summernote, .summerbody');

        $(editor).each(function (index) {
            let ele = $(this)[0];
            let height = $(this).data('height');
            editors(ele, height);
        })
        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })

</script>
