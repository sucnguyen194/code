<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.categories.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}} {{__('lang.category')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.create.nav')
                <div class="tab-content">
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane  {{$key == 0 ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            @include('admin.render.create.title')

                            @include('admin.render.create.slug')

                            @include('admin.render.create.description')
                        </div>
                    @endforeach
                </div>

                @include('admin.render.group')

                <div class="form-group position-relative">
                    @include('admin.render.create.media')
                </div>

                <div class="form-group position-relative">
                    @include('admin.render.create.background')
                </div>
                <input type="hidden" name="data[type]" value="{{\App\Enums\CategoryType::product}}">
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
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

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': '{{__("lang.api_img_not_configured")}}', 'type': 'error'});

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
                var obj  = {
                    'message': '{{__('lang.error')}} {{__('lang.upload')}}: '+error,
                    'type' :'error'
                };
                flash(obj);
                console.error("Error:", error);
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

