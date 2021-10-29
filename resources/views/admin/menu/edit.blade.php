<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.menus.update',$menu)}}" method="post" class="ajax-form-menu" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu #ID{{$menu->id}}</h5>
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
                                    <label>Tiêu đề <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="translation[{{$key}}][name]" value="{{$translation->name}}" >
                                </div>
                                <div class="form-group">
                                    <label>Đường dẫn <span class="required">*</span></label>
                                    <div class="d-flex form-control">
                                        <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{$translation->language->name}}" onkeyup="ChangeToSlug(this);"name="translation[{{$key}}][slug]">
                                        <span>.html</span>
                                    </div>
                                    <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                                </div>
                            </div>
                        @endforeach

                        @if(setting('site.languages'))

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane" id="language-{{$language->value}}">
                                    <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
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
                                </div>
                            @endforeach
                        @endif

                            <div class="form-group">
                                <label>Đường dẫn ngoài</label>
                                <input type="text" class="form-control" id="path" value="{{$menu->path}}" name="data[path]">
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select id="parent_id" name="data[parent_id]" class="form-control" data-toggle="select2">
                                    <option value="0">-----</option>
                                    @foreach($menus as $items)
                                        <option value="{{$items->id}}" {{selected($menu->parent_id, $items->id)}}>{{$items->translation->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Target</label>
                                <select id="target" name="data[target]" class="form-control" data-toggle="select2">
                                    <option {{selected($menu->target,'_self')}} value="_self">-----</option>
                                    <option {{selected($menu->target,'_parent')}} value="_parent">_parent</option>
                                    <option {{selected($menu->target,'_top')}} value="_top">_top</option>
                                    <option {{selected($menu->target,'_blank')}} value="_blank">_blank</option>
                                    <option {{selected($menu->target,'_self')}} value="_self">_self</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kiểu menu</label>
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
                                        <label class="form-label">Icon</label>
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
                                <label>Vị trí</label>
                                <select id="position" class="form-control" data-toggle="select2" name="data[position]">
                                    <option value="top" {{selected($menu->position,'top')}} class="form-control">MENU TOP</option>
                                    <option value="home" {{selected($menu->position,'home')}} class="form-control">MENU HOME</option>
                                    <option value="left" {{selected($menu->position,'left')}} class="form-control">MEN LEFT</option>
                                    <option value="right" {{selected($menu->position,'right')}} class="form-control">MENU RIGHT</option>
                                    <option value="bottom" {{selected($menu->position,'bottom')}} class="form-control">MENU BOTTOM</option>
                                </select>
                                <textarea id="nestable-output" name="menuval" style="display: none;"></textarea>
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
