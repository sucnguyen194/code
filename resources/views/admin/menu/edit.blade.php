<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.menus.update',$menu)}}" method="post" class="ajax-form-menu" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_menu')}} #{{$menu->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.edit.nav')
                    <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane  {{$translation->locale == session('lang') ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                                <div class="form-group">
                                    <label>{{__('_title')}}</label>
                                    <input type="text" class="form-control" name="translation[{{$key}}][name]" value="{{$translation->name}}" >
                                </div>
                                <div class="form-group">
                                    <label>{{__('_slug')}}</label>
                                    <div class="d-flex form-control">
                                        <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{$translation->language->name}}" name="translation[{{$key}}][slug]">
                                        <span>.html</span>
                                    </div>
                                    <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                                </div>
                            </div>
                        @endforeach

                        @if(setting('site.languages') || !$menu->translation)

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                    <div class="tab-pane  {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                                        <div class="form-group">
                                            <label>{{__('_title')}}</label>
                                            <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][name]" >
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('_slug')}} </label>
                                            <div class="d-flex form-control">
                                                <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
                                                <span>.html</span>
                                            </div>
                                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                                        </div>
                                    </div>
                            @endforeach
                        @endif

                            <div class="form-group">
                                <label>{{__('_path')}}</label>
                                <input type="text" class="form-control" id="path" value="{{$menu->path}}" name="data[path]">
                            </div>
                            <div class="form-group">
                                <label>{{__('_group')}}</label>
                                <select id="parent_id" name="data[parent_id]" class="form-control" data-toggle="select2">
                                    <option value="0">-----</option>
                                    @include('admin.render.options', ['options' => $menus, 'selected' => $menu->parent_id])
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{__('_target')}}</label>
                                <select id="target" name="data[target]" class="form-control" data-toggle="select2">
                                    <option {{selected($menu->target,'_self')}} value="_self">-----</option>
                                    <option {{selected($menu->target,'_parent')}} value="_parent">_parent</option>
                                    <option {{selected($menu->target,'_top')}} value="_top">_top</option>
                                    <option {{selected($menu->target,'_blank')}} value="_blank">_blank</option>
                                    <option {{selected($menu->target,'_self')}} value="_self">_self</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('_type')}}</label>
                                <select id="type" name="data[type]" class="form-control" data-toggle="select2">
                                    <option {{selected($menu->type,'default')}} value="default">Default</option>
                                    <option {{selected($menu->type,'mega')}} value="mega">Mega Menu</option>
                                </select>
                            </div>

                            <div class="form-group position-relative">
                                <div class="media">
                                    <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
                                        <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
                                            <img src="{{$menu->image}}" class="image_src {{!$menu->image ? "d-none" : ""}}" id="image_src" width="100%" height="100%">
                                        </div>
                                    </div>
                                    <div class="media-body ml-3">
                                        <label class="form-label">{{__('_icon')}}</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="data[image]" id="image_url" data-target="#image_src" value="{{$menu->image}}"  type="text" class="form-control" placeholder="http://">
                                                <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >Upload..</label>
                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('_position')}}</label>

                                <select id="position" class="form-control" data-toggle="select2" name="data[position]">
                                    @foreach(\App\Enums\MenuPosition::getInstances() as $item)
                                        <option value="{{$item->value}}" {{selected($item->value,$menu->value)}} class="form-control">{{__('_menu')}} {{$item->description}}</option>
                                    @endforeach
                                </select>
                                <textarea id="nestable-output" name="menuval" style="display: none;"></textarea>
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
                alert('Lỗi upload: '+error);
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
