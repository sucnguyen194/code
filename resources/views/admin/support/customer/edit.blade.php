<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.supports.update',$customer)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ý kiến khách hàng #ID{{$customer->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(setting('site.languages'))
                    <ul class="nav nav-tabs tabs-bordered nav-justified pt-1 bg-white" style="margin-bottom: 20px">
                        @foreach($translations as $key => $translation)
                            <li class="nav-item">
                                <a href="#language-{{$translation->locale}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$key == 0 ? 'active' : null}}">
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
                        <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                            <div class="form-group">
                                <label for="name">Tên khách hàng <span class="required">*</span></label>
                                <input type="text" class="form-control" name="translation[{{$key}}][name]" id="name" value="{{$translation->name}}">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span id="basic-addon1" class="input-group-text">Công việc</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$translation->job}}" id="job" name="translation[{{$key}}][job]">
                                </div>
                            </div>
                            <div class="form-group" style="max-width: 770px">
                                <label for="description">Đánh giá </label>
                                <textarea class="form-control summernote" id="summernote" data-height="200"
                                          name="translation[{{$key}}][description]">{!! $translation->description !!}</textarea>
                            </div>
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                        </div>
                    @endforeach

                    @if(setting('site.languages'))

                        @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                            <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                                <div class="form-group">
                                    <label>Tên khách hàng <span class="required">*</span></label>
                                    <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" name="translation[{{$key}}][name]" >
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span id="basic-addon1" class="input-group-text">Công việc</span>
                                        </div>
                                        <input type="text" class="form-control" id="job" name="translation[{{$key}}][job]">
                                    </div>
                                </div>
                                <div class="form-group" style="max-width: 770px">
                                    <label for="description">Đánh giá</label>
                                    <textarea class="form-control summernote" id="summernote" data-height="200"
                                              name="translation[{{$key}}][description]"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->locale}}">
                        @endforeach
                    @endif

                    <div class="form-group position-relative">
                        <div class="media">
                            <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
                                <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
                                    <img src="{{$customer->image}}" class="image_src {{!$customer->image ? "d-none" : ""}}" id="image_src" width="100%" height="100%">
                                </div>
                            </div>
                            <div class="media-body ml-3">
                                <label class="form-label">Hình ảnh</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="data[image]" id="image_url" value="{{$customer->image}}" data-target="#image_src"  type="text" class="form-control" placeholder="http://">
                                        <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >Upload..</label>
                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">SĐT</span>
                            </div>
                            <input type="tel" class="form-control" id="hotline" value="{{$customer->hotline}}" name="data[hotline]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">Email</span>
                            </div>
                            <input type="email" class="form-control" id="email" value="{{$customer->email}}"
                                   name="data[email]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">Skype</span>
                            </div>
                            <input type="text" class="form-control" value="{{$customer->skype}}" id="skype"
                                   name="data[skype]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">Facebook</span>
                            </div>
                            <input type="url" class="form-control" value="{{$customer->facebook}}" id="facebook"
                                   name="data[facebook]">
                        </div>
                    </div>
                </div>
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
                    "Authorization": "Client-ID " + imgur_client_id
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
