<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.products.update',$video)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.video')}} #ID{{$video->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.edit.nav')

                    <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane  {{$key == 0 ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                                @include('admin.render.edit.title')
                                @include('admin.render.edit.slug')
                            </div>
                        @endforeach

                        @if(setting('site.languages'))

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane" id="language-{{$language->value}}">
                                    <div class="tab-pane language-{{$language->value}}" id="language-{{$language->value}}">
                                        @include('admin.render.create.title')
                                        @include('admin.render.create.slug')
                                    </div>
                                </div>
                            @endforeach
                        @endif


                            <div class="form-group">
                                <label>{{__('lang.slug')}} {{__('lang.video')}} Youtube <span class="required">*</span></label>
                                <p class="font-13"><code>*</code> {{__('lang.note_url_video')}}</p>
                                <p><img src="{{asset('lib/images/note_upload_video.png')}}" class="w-auto"></p>
                                <input class="form-control" value="https://www.youtube.com/watch?v={{$video->video}}" name="data[video]" required>

                            </div>

                            <div class="form-group position-relative">
                                @include('admin.render.edit.media', ['item' => $video])
                            </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="d-none">
                    @include('admin.render.edit.status', ['item' => $video])
                </div>
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
                    'message': '{{__("lang.error")}} {{__("lang.upload")}}: '+error,
                    'type' :'error'
                };
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
    })

</script>
