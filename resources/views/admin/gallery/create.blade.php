<div class="modal-dialog modal-lg" style="max-width: 800px!important" role="document">
    <form action="{{route('admin.posts.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
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
                    <div class="form-group position-relative box-action-image">
                        @include('admin.render.create.multiple_image')
                    </div>

                    @foreach(languages() as $key => $language)
                        <div class="tab-pane  {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                           @include('admin.render.create.title')
                           @include('admin.render.create.description')

                            <div class="form-group">
                                @include('admin.render.create.seo')
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="data[type]" value="{{\App\Enums\PostType::gallery}}">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
<div id="viewImage" class="modal fade modal-gallery" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_image')}}</h5>
                <button type="button" class="close" onclick="jQuery('.modal-gallery').modal('hide');" data-dismiss="modal-gallery" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid showImage">
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> Đóng</button>--}}
{{--            </div>--}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    #ajax-modal {
        overflow-y: scroll;
    }
</style>
<script src="/lib/tinymce/tinymce.min.js"></script>
<script src="/lib/js/cpanel.js"></script>
<script>
    $(document).on('click','.view-image',function(){
        let image = $(this).attr('data-image');
        $('.showImage').attr('src', image);
    })
</script>
<script type="text/javascript">
    $( "#sortable" ).sortable();
</script>
<script type="text/javascript">
    $('#slider-file').on('change', function () {

        let count = $(this)[0].files.length;
        let slider = $('.slider-holder');

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': '{{__("_api_not_configured")}}', 'type': 'error'});

        for(var i=0 ; i < count ; i++){
            let file = $(this).prop('files')[i];
            if (!file)
                return false;

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
                    $(slider).removeClass('d-none').addClass('d-inline-block');

                    $('<li class="box-product-images">' +
                        '<div class="item-image position-relative">' +
                        '<div class="img-rounded"><img src="'+result.data.link+'" class="position-image-product"/></div>' +
                        '<input name="photos[]" type="hidden" value="'+ result.data.link +'">' +
                        '<div class="photo-hover-overlay">' +
                        '<div class="box-hover-overlay">' +
                        '<a class="tooltip-hover view-image text-white" data-image="'+result.data.link+'" data-toggle="modal" data-target="#viewImage" title="{{__('lang.detail')}}">' +
                        '<i class="far fa-eye"></i>' +
                        '</a>' +
                        '<a class="pl-2 tooltip-hover text-white" id="slider-delete" title="{{__('lang.destroy')}}">' +
                        '<i class="far fa-trash-alt"></i>' +
                        '</a>' +
                        '</div> '+
                        '</div>' +
                        '</div>' +
                        '</li>').appendTo(slider);
                    $('#remove-label').removeClass('d-block').hide();
                    $('.loading').fadeOut();
                })
                .catch(error => {
                    $('#remove-label').show();
                    $(slider).addClass('d-none');
                        var obj  = {
                            'message': '{{__('_error')}} {{__('_upload')}}: '+error,
                            'type' :'error'
                        };
                     flash(obj);

                });
        }

    });

    $(document).on('click','#slider-delete',function(){
        let slider = document.getElementsByClassName('slider-holder');
        let remove = document.getElementById('remove-label');
        $(this).parent().parent().parent().parent().remove();

        if($(slider).children().length == 0){
            $(slider).addClass('d-none').removeClass('d-inline-block');
            $(remove).removeClass('d-none').show();
        }
    });
    $(document).on('change','#slider-input',function(){

        let parent = $(this).parent().parent().parent().parent();

        $(parent).find('div > img').attr('src', $(this).val());
    })

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


