<div class="modal-dialog" role="document">
    <form action="{{route('admin.photos.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <div id="photo-holder" class="d-none pt-2 row"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Vị trí hiển thị</label>
                    <select data-toggle="select2" name="data[position]" class="form-control">
                        <option value="Nomal">----</option>
                        @foreach(\App\Enums\Position::getInstances() as $item)
                            <option value="{{$item->value}}">{{$item->description}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Target</label>
                    <select id="target" name="data[target]" class="form-control" data-toggle="select2">
                        <option value="_self">-----</option>
                        <option value="_parent">_parent</option>
                        <option value="_top">_top</option>
                        <option value="_blank">_blank</option>
                        <option value="_self">_self</option>
                    </select>
                </div>
                <div class="form-group {{!setting('site.languages') ? "d-none" : "" }} ">
                    <label>Ngôn ngữ</label>
                    <select data-toggle="select2" name="data[lang]" class="form-control">
                        <option value="Nomal">----</option>
                        @if(setting('site.languages'))
                            @foreach(languages() as $item)
                                <option value="{{$item->value}}" {{selected($item->value, session('lang'))}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>
                <input type="hidden" name="data[type]" value="{{\App\Enums\PhotoType::photo}}">

                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại
                </button>
            </div>
        </div>
    </form>
</div>

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

<script>
    $('#slider-file').on('change', function () {

        let count = $(this)[0].files.length;
        let slider = $('#photo-holder');

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': 'API IMG chưa được cấu hình!', 'type': 'error'});

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
                        "Authorization": "Client-ID "+ imgur_client_id
                    },
                }
            )
                .then(response => response.json())
                .then(result => {

                    let img = '<div class="form-group col-md-12 media" style="min-height:1px">';
                    img += '<div style="width: 100px; height: 116px; border: 1px solid #ddd; position: relative">';
                    img += '<img alt="Slider" src="'+result.data.link+'" width="100%" height="100%" style="position: absolute;top:0;left: 0;right: 0;bottom: 0;object-fit: contain">';
                    img += '</div>';
                    img += '<div class="media-body ml-3">';
                    img += '<div class="form-group mb-1">';
                    img += '<div class="input-group">';
                    img += ' <input name="images[]" id="slider-input" type="text" class="form-control" value="'+result.data.link+'" placeholder="http://" >';
                    img += '<span class="input-group-append">';
                    img += '<label class="btn btn-default mb-0" type="button"><input type="button" class="d-none" id="photo-delete">Delete</label>';
                    img += '</span>';
                    img += '</div></div>';

                    img += '<div class="form-group mb-1">';
                    img += ' <input name="name[]" type="text" class="form-control" value="" placeholder="Tiêu đề">';
                    img += '</div>';

                    img += '<div class="form-group mb-0">';
                    img += ' <input name="path[]" type="url" class="form-control" value="" placeholder="http://">';
                    img += '</div>';

                    img += '</div></div>';

                    $(slider).removeClass('d-none');
                    $(img).appendTo(slider);
                    $('#remove-label').hide();
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
                });
        }

    });

    $(document).on('click','#photo-delete',function(){

        let slider = document.getElementById('photo-holder');
        let remove = document.getElementById('remove-label');
        $(this).closest('.media').remove();

        if($(slider).children().length == 0){

            $(slider).addClass('d-none').removeClass('d-inline-block');
            $(remove).removeClass('d-none').show();
        }
    })
    $(document).on('change','#slider-input',function(){

        let parent = $(this).parent().parent().parent().parent();

        $(parent).find('div > img').attr('src', $(this).val());
    })
</script>
