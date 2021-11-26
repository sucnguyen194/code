<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.categories.add')}}" method="post" class="ajax-select" data-selected="{{request()->selected}}" data-option="{{request()->option}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}} <span class="text-lowercase">{{__('lang.category')}}</span></h5>
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
                            <label>{{__('lang.title')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" language="category_{{$language->value}}"
                                   onkeyup="ChangeToSlug(this);"
                                   name="translation[{{$key}}][name]">
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.slug')}} <span class="required">*</span></label>
                                <div class="d-flex form-control">
                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="category_{{$language->value}}" value="" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
                                    <span>.html</span>
                                </div>
                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                            </div>
                        </div>
                    @endforeach
                </div>

                @include('admin.render.group')
                <input type="hidden" name="data[type]" value="{{request()->type}}">
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
            return flash({'message': '{{__("lang.api_img_not_configured")}}', 'type': 'error'});

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
                var obj  = {
                    'message': '{{__('lang.error')}} {{__('lang.upload')}}: '+error,
                    'type' :'error'
                };
                flash(obj);
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
