<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.languages.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>{!! __('lang.list_language') !!} <span class="required">*</span></label>
                    @foreach($languages as $item)
                        <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer"><cite title="{{$item->name}} ({{$item->value}})" class="font-weight-bold">{{$item->name}} ({{$item->value}})</cite></footer>
                        </blockquote>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>{!! __('lang.language') !!} <span class="required">*</span></label>
                    <input type="text" class="form-control" value="" name="name" required>
                </div>
                <div class="form-group">
                    <label>{!! __('lang.value') !!} <span class="required">*</span></label>
                    <p class="font-13"><code>*</code> {{__('lang.max')}} 2 {{__('lang.characters')}} </p>
                    <input type="text" maxlength="2" value="" name="value" class="form-control" id="alloptions" />
                </div>

                <div class="form-group position-relative">
                    @include('admin.render.create.media')
                </div>

            </div>
            <div class="modal-footer">
               @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>

<script src="{{asset('lib/assets/js/pages/form-advanced.init.js')}}"></script>
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
