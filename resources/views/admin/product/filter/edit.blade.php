<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.filters.update',$filter)}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_filter')}} #{{$filter->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
               @include('admin.render.edit.nav')

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach($translations as $key => $translation)
                        <div class="tab-pane {{$translation->locale == session('lang') ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                            @include('admin.render.edit.title')
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                        </div>
                    @endforeach

                    @foreach(languages()->whereNotIn('value',$translations->pluck('locale')->toArray()) as $key => $language)
                        <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            @include('admin.render.create.title')
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                        </div>
                    @endforeach

                </div>

                <div class="form-group">
                    <label>{{__('_color')}}</label>

                    <div class="input-group colorpicker-default" data-color-format="rgb"
                         data-color="{{$filter->color}}">
                        <input type="text" readonly="readonly" value="{{$filter->color}}" name="data[color]" class="form-control">
                        <div class="input-group-append add-on">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group position-relative">
                    <div class="media">
                        <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
                            <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
                                <img src="{{$filter->image}}" class="image_src {{!$filter->image ? "d-none" : ""}}" id="image_src" width="100%" height="100%">
                            </div>
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">{{__('_icon')}}</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="data[image]" id="image_url" data-target="#image_src" value="{{$filter->image}}"  type="text" class="form-control" placeholder="http://">
                                    <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >@lang('_upload')...</label>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{__('_group')}}</label>
                    <select class="form-control" data-toggle="select2" name="data[parent_id]">
                        <option value="0">-----</option>
                        @foreach($categories as $item )
                            <option value="{{$item->id}}" {{selected($filter->parent_id, $item->id)}} class="font-weight-bold">{{$item->translation->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
        <link href="/lib/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/lib/assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
        <script src="/lib/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script>
    $(document).ready(function () {
        $(".colorpicker-default").colorpicker({format: "hex"});
    });
</script>
<script type="text/javascript">
    $('#image-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': '{{__("_api_not_configured")}}', 'type': 'error'});

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
                alert('@lang('_error'): '+error);
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

        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });

        $('#example-color').on('change',function (){
            var color = $(this).val();
            $('#data-color').val(color);
        });
    })

</script>
