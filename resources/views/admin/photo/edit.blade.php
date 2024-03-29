<div class="modal-dialog modal-dialog-centered" role="document">
    <form action="{{route('admin.photos.update',$photo)}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_image')}} #{{$photo->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group position-relative box-action-image">
                    <label>{{__('_image')}}</label>
                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:0;top:0">
                        <label class="item-input mb-0">
                            <input type="file" id="image-upload" class="d-none image-upload" data-target="#image_url"> {{__('_select_image')}}
                        </label>
                    </div>
                    <p class="font-13"><code>*</code> {!! __('_note_upload_image') !!}</p>
                    <div class="dropzone text-center pl-2 pr-2 pb-1 pt-2">
                        <img src="{{$photo->image}}" class="rounded img-thumbnail" id="image_src">

                        <div class="input-group mt-2 mb-1">
                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                            <input type="text" name="data[image]" placeholder="Đường dẫn ảnh" id="image_url" value="{{$photo->image}}" class="form-control image-src" data-target="#image_src" data-hidden="#image_hidden">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{__('_title')}}</label>
                    <input type="text" value="{{$photo->name}}" name="data[name]" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{__('_description')}}</label>
                    <textarea class="form-control" name="data[description]" rows="6">{!! $photo->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label>{{__('_slug')}}</label>
                    <input type="url" value="{{$photo->path}}" name="data[path]" placeholder="http://" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{__('_position')}}</label>

                    <select data-toggle="select2" name="data[position]" class="form-control">
                        <option value="Nomal">----</option>
                        @foreach(\App\Enums\Position::getInstances() as $item)
                            <option value="{{$item->value}}" {{selected($item->value, $photo->position)}}>{{$item->description}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('_target')}}</label>
                    <select id="target" name="data[target]" class="form-control" data-toggle="select2">
                        <option value="_self">-----</option>
                        <option value="_parent" {{selected($photo->target, '_parent')}}>_parent</option>
                        <option value="_top" {{selected($photo->target, '_top')}}>_top</option>
                        <option value="_blank" {{selected($photo->target, '_blank')}}>_blank</option>
                        <option value="_self" {{selected($photo->target, '_self')}}>_self</option>
                    </select>
                </div>
                <div class="form-group {{!setting('site.languages') ? "d-none" : "" }} ">
                    <label>{{__('_language')}}</label>
                    <select data-toggle="select2" name="data[lang]" class="form-control">
                        <option value="Nomal">----</option>
                        @foreach(languages() as $item)
                            <option value="{{$item->value}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> {{__('_back')}}
                </button>
                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> {{__('_save')}}
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
            return flash({'message': '{{__('_api_not_configured')}}', 'type': 'error'});

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
                alert('@lang('_error'): '+error);
            });

    });
</script>
<script type="text/javascript">
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
        });

        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })

</script>
