<div class="modal-dialog modal-dialog-centered" role="document">
    <form action="{{route('admin.tags.add')}}" method="post" class="ajax-select w-100" data-selected="{{request()->selected}}" data-option="{{request()->option}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}}</h5>
                <button type="button" class="close close-tag" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(setting('site.languages'))
                    <ul class="nav nav-tabs tabs-bordered nav-justified bg-white">
                        @foreach(languages() as $key => $language)
                            <li class="nav-item">
                                <a href=".language-{{$language->value}}-tag" data-toggle="tab" aria-expanded="false" class="nav-link {{$language->value == session('lang') ? 'active' : null}}">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">{{$language->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="tab-content {{!setting('site.languages') ? "pt-0" : ""}}">
                    @foreach(languages() as $key => $language)
                        <div class="tab-pane {{$language->value == session('lang') ? 'active' : null}} language-{{$language->value}}-tag" id="language-{{$language->value}}-tag">
                            <div class="form-group">
                                <label>{{__('_tag')}} <span class="required">*</span></label>
                                <input type="text" class="form-control" language="tag_{{$language->value}}"
                                       onkeyup="ChangeToSlug(this);"
                                       name="translation[{{$key}}][name]">
                            </div>
                            <div class="form-group mb-0">
                                <label>{{__('_slug')}} <span class="required">*</span></label>
                                <div class="d-flex form-control">
                                    <span>{{route('home')}}/tag/</span><input type="text" class="border-0 slug" id="tag_{{$language->value}}" value="" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
{{--                                    <span>.html</span>--}}
                                </div>
                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="data[type]" value="{{request()->type}}">
               @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
