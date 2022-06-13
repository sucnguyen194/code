<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.menus.store')}}" method="post" class="ajax-form-menu w-100" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               @include('admin.render.create.nav')

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            <div class="form-group">
                                <label>{{__('_title')}}</label>
                                <input type="text" class="form-control" language="{{$language->value}}"
                                       seo="{{$language->name}}" onkeyup="ChangeToSlug(this);"
                                       name="translation[{{$key}}][name]">
                            </div>
                            <div class="form-group">
                                <label>{{__('_slug')}} </label>
                                <div class="d-flex form-control">
                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug"
                                                                          id="{{$language->value}}"
                                                                          value="{{old('data.alias')}}"
                                                                          language="{{$language->value}}"
                                                                          seo="{{$language->name}}"
                                                                          onkeyup="ChangeToSlug(this);"
                                                                          name="translation[{{$key}}][slug]">
{{--                                    <span>.html</span>--}}
                                </div>
                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>{{__('_path')}}</label>
                    <input type="text" class="form-control" id="path" value="{{old('data.path')}}" name="data[path]">
                </div>
                <div class="form-group">
                    <label>{{__('_group')}}</label>
                    <select id="parent_id" name="data[parent_id]" class="form-control" data-toggle="select2">
                        <option value="0" selected>-----</option>
                        @include('admin.render.options', ['options' => $menus, 'selected' => 0])
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('_target')}}</label>
                    <select id="target" name="data[target]" class="form-control" data-toggle="select2">
                        <option value="_self">-----</option>
                        <option value="_parent">_parent</option>
                        <option value="_top">_top</option>
                        <option value="_blank">_blank</option>
                        <option value="_self">_self</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('_type')}}</label>
                    <select id="type" name="data[type]" class="form-control" data-toggle="select2">
                        <option value="default">Default</option>
                        <option value="mega">Mega Menu</option>
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
                            <label class="form-label">{{__('_icon')}}</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="data[image]" id="image_url" data-target="#image_src" type="text"
                                           class="form-control" placeholder="http://">
                                    <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file"
                                                                                     class="d-none image-upload"
                                                                                     id="image-upload"
                                                                                     data-target="#image_url">{{__('_upload')}}...</label>
                            </span>
                                </div>
                            </div>
                            <input type="hidden" name="data[position]" value="{{session('menu_position')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
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
            return flash({'message': '{{__("_api_not_configured")}}', 'type': '{{__('_error')}}'});

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
                alert('{{__('_error')}}' + error);
            });

    });

    $('#image_url').on('change', function () {
        let target = $(this).data('target');
        let hidden = $(this).data('hidden');
        if ($(this).val()) {
            $(target).removeClass('d-none').attr('src', $(this).val()).show();
            $(hidden).hide();
        } else {
            $(target).hide();
            $(hidden).removeClass('d-none').show();
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('select:not(".select2-multiple")').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            }).on('change', function(e){
                var span = $('.select2-selection__rendered');

                $.each(span, function (index, value) {
                    var html = $(value).html();
                    html = html.replaceAll('&nbsp;', "");
                    $(value).html(html);
                });
            });

            var span = $('.select2-selection__rendered');

            $.each(span, function (index, value) {
                var html = $(value).html();
                html = html.replaceAll('&nbsp;', "");
                $(value).html(html);
            });
        });

        $("select.select2-multiple").on("select2:select select2:unselect", function (e) {
            var li = $('li.select2-selection__choice');

            $.each(li, function (index, value) {
                var html = $(value).html();
                html = html.replaceAll('&nbsp;', "");
                $(value).html(html);
            })
        });
        var li = $('li.select2-selection__choice');

        $.each(li, function (index, value) {
            var html = $(value).html();
            html = html.replaceAll('&nbsp;', "");
            $(value).html(html);
        })
    })
</script>
