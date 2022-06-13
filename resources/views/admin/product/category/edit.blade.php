<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.categories.update',$category)}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_category_product')}} #{{$category->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.edit.nav')
                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach($translations as $key => $translation)
                        <div class="tab-pane  {{$translation->locale == session('lang') ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                            @include('admin.render.edit.title')
                            @include('admin.render.edit.slug')
                            @include('admin.render.edit.description')
                        </div>
                    @endforeach

                   @if(setting('site.languages') || !$category->translation)

                    @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                        <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            @include('admin.render.create.title')

                            @include('admin.render.create.slug')

                            @include('admin.render.create.description')
                        </div>
                    @endforeach

                    @endif
                </div>

                @include('admin.render.group')

                <div class="form-group position-relative">
                    @include('admin.render.edit.media',['item' => $category])
                </div>

                <div class="form-group position-relative">
                    @include('admin.render.edit.background',['item' => $category])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal"
                        aria-label="Close">
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
<script src="/lib/tinymce/tinymce.min.js"></script>
<script src="/lib/js/cpanel.js"></script>
<script type="text/javascript">
    $('.image-upload, .background-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

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
                var obj  = {
                    'message': '@lang('_error'): '+error,
                    'type' :'error'
                };
                flash(obj);
            });

    });

    $('.image_url, .background_url').on('change', function (){

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
        $('select').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            }).on('change', function(e){
                var data = $(this).find('option:selected').text();
                var text = data.replaceAll(/\xA0/g, "");
                $(this).closest('.form-group').find('.select2-selection__rendered').text(text);
            });

            var text = $(this).find('option:selected').text();
            text = text.replaceAll(/\xA0/g, "");
            $(this).closest('.form-group').find('.select2-selection__rendered').text(text);
        });
    })
</script>

