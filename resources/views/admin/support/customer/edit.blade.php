<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.supports.update',$customer)}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_customer_reviews')}} #{{$customer->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.edit.nav')

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach($translations as $key => $translation)
                        <div class="tab-pane {{$translation->locale == session('lang') ? 'active' : null}} language-{{$translation->locale}}" id="language-{{$translation->locale}}">
                            <div class="form-group">
                                <label for="name">{{__('_customer')}} <span class="required">*</span></label>
                                <input type="text" class="form-control" name="translation[{{$key}}][name]" id="name" value="{{$translation->name}}">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span id="basic-addon1" class="input-group-text">{{__('_job')}}</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$translation->job}}" id="job" name="translation[{{$key}}][job]">
                                </div>
                            </div>
                            <div class="form-group" style="max-width: 770px">
                                <label for="description">{{__('_comment')}} </label>
                                <textarea class="form-control summernote" id="summernote" data-height="200"
                                          name="translation[{{$key}}][description]">{!! $translation->description !!}</textarea>
                            </div>
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                        </div>
                    @endforeach

                    @if(setting('site.languages') || !$customer->translation)

                        @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                            <div class="tab-pane  {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                                <div class="form-group">
                                    <label>{{__('_customer')}} <span class="required">*</span></label>
                                    <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" name="translation[{{$key}}][name]" >
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span id="basic-addon1" class="input-group-text">{{__('_job')}}</span>
                                        </div>
                                        <input type="text" class="form-control" id="job" name="translation[{{$key}}][job]">
                                    </div>
                                </div>
                                <div class="form-group" style="max-width: 770px">
                                    <label for="description">{{__('_comment')}}</label>
                                    <textarea class="form-control summernote" id="summernote" data-height="200"
                                              name="translation[{{$key}}][description]"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->locale}}">
                        @endforeach
                    @endif

                    <div class="form-group position-relative">
                        @include('admin.render.edit.media', ['item' => $customer])
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">{{__('_phone')}}</span>
                            </div>
                            <input type="tel" class="form-control" id="hotline" value="{{$customer->hotline}}" name="data[hotline]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">{{__('_email')}}</span>
                            </div>
                            <input type="email" class="form-control" id="email" value="{{$customer->email}}"
                                   name="data[email]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">Skype</span>
                            </div>
                            <input type="text" class="form-control" value="{{$customer->skype}}" id="skype"
                                   name="data[skype]">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-addon1" class="input-group-text">Facebook</span>
                            </div>
                            <input type="url" class="form-control" value="{{$customer->facebook}}" id="facebook"
                                   name="data[facebook]">
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
<script src="/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var links = "{{route('home')}}";

    $(document).ready(function(){
        tinymce.init({
            language : 'vi',
            plugins: "wordcount textcolor image  link  anchor   charmap media   lists responsivefilemanager",
            toolbar: [
                'fontsizeselect | bold italic underline strikethrough  | alignleft aligncenter alignright alignjustify | removeformat',

            ],
            height : "150",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],
            relative_urls: false,
            selector: ".summernote",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links+"/lib/filemanager/",
            external_plugins: {"filemanager": links+"/lib/filemanager/plugin.min.js"}
        });

    });
</script>
<script type="text/javascript">
    $('#image-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': '{{__('_api_not_configured')}}', 'type': 'error'});

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
    })

</script>
