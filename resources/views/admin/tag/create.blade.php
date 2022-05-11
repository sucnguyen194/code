
<div class="modal-dialog modal-tag modal-lg" style="max-width: 800px!important" role="document">
    <form action="{{route('admin.tags.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}} <span class="text-lowercase">{{__('lang.tag')}}</span></h5>
                <button type="button" class="close close-tag" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.render.create.nav')

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    <div class="form-group">
                        <select class="form-control" data-toggle="select2" name="data[type]" data-placeholder="{{__('lang.classify')}}">
                            <option value="">{{__('lang.classify')}}</option>
                            @foreach(\App\Enums\TagType::getInstances() as $item)
                                <option value="{{$item->value}}">{{__('lang.'.$item->value)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane  {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}" id="language-{{$language->value}}">
                            <div class="form-group">
                                <label>{{__('lang.tag')}} <span class="required">*</span></label>
                                <input type="text" class="form-control" language="{{$language->value}}"
                                       seo="{{$language->name}}" onkeyup="ChangeToSlug(this);"
                                       name="translation[{{$key}}][name]">
                            </div>
                           @include('admin.render.create.description')

                            <div class="form-group">
                                @include('admin.render.create.seo')
                            </div>
                        </div>
                    @endforeach
                </div>
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
    $(document).ready(function () {
        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })
</script>


