
<div class="modal-dialog modal-lg" style="max-width: 800px!important" role="document">
    <form action="{{route('admin.tags.update',$tag)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.tag')}} #ID{{$tag->id}}</h5>
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
                    <div class="form-group">
                        <select class="form-control" data-toggle="select2" name="data[type]" data-placeholder="{{__('lang.classify')}}">
                            <option value="">{{__('lang.classify')}}</option>
                            @foreach(\App\Enums\TagType::getInstances() as $item)
                                <option value="{{$item->value}}" {{selected($item->value, $tag->type)}}>{{__('lang.'.$item->value)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($translations as $key => $translation)
                        <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                            <div class="form-group">
                                <label>Tag <span class="required">*</span></label>
                                <input type="text" class="form-control" name="translation[{{$key}}][name]" value="{{$translation->name}}" >
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.description')}}</label>
                                <textarea class="form-control summerdescription" data-height="200" id="summernote" name="translation[{{$key}}][description]">{!! $translation->description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="d-flex mb-2">
                                    <label class="font-weight-bold">{{__('lang.optimization')}} SEO</label>
                                    <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">{{__('lang.edit')}} SEO</a>
                                </div>

                                <p class="font-13">{{__('lang.note_seo')}}</p>
                                <div class="test-seo">
                                    <div class="mb-1">
                                        <a href="javascript:void(0)" class="title-seo" id="title_seo_{{$translation->locale}}">{{$translation->title_seo}}</a>
                                    </div>
                                    <div class="url-se">
                                        <span class="slug-seo" id="{{$translation->language->name}}">{{route('slug', $translation->slug)}}</span>
                                    </div>
                                    <div class="description-seo" id="description_seo_{{$translation->locale}}">{{$translation->description_seo}}</div>
                                </div>
                                <div class="change-seo" id="change-seo">
                                    <hr>
                                    <div class="form-group">
                                        <label>{{__('lang.title')}}</label>
                                        <p class="font-13"><code>*</code> {{__('lang.max')}} 70 {{__('lang.characters')}}</p>
                                        <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" value="{{$translation->title_seo}}" language="title_seo_{{$translation->locale}}" onkeyup="changeToTitleSeo(this)" />
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('lang.description')}}</label>
                                        <p class="font-13"><code>*</code> {{__('lang.max')}} 320 {{__('lang.characters')}}</p>
                                        <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$translation->locale}}" onkeyup="changeToDescriptionSeo(this)">{{$translation->description_seo}}</textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label>{{__('lang.slug')}} <span class="required">*</span></label>
                                        <div class="d-flex form-control">
                                            <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{$translation->language->name}}" onkeyup="ChangeToSlug(this);"name="translation[{{$key}}][slug]">
                                            <span>.html</span>
                                        </div>
                                        <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(setting('site.languages'))

                        @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                            <div class="tab-pane" id="language-{{$language->value}}">
                                <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                                    <div class="form-group">
                                        <label>Tag <span class="required">*</span></label>
                                        <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][name]" >
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('lang.description')}}</label>
                                        <textarea class="form-control summerdescription" data-height="200" id="summernote" name="translation[{{$key}}][description]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex mb-2">
                                            <label class="font-weight-bold">{{__('lang.optimization')}} SEO</label>
                                            <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">{{__('lang.edit')}} SEO</a>
                                        </div>

                                        <p class="font-13">{{__('lang.note_seo')}}</p>
                                        <div class="test-seo">
                                            <div class="mb-1">
                                                <a href="javascript:void(0)" class="title-seo" id="title_seo_{{$language->value}}"></a>
                                            </div>
                                            <div class="url-se">
                                                <span class="slug-seo" id="{{$language->name}}">{{route('home')}}</span>
                                            </div>
                                            <div class="description-seo" id="description_seo_{{$language->value}}"></div>
                                        </div>
                                        <div class="change-seo" id="change-seo">
                                            <hr>
                                            <div class="form-group">
                                                <label>{{__('lang.title')}} SEO</label>
                                                <p class="font-13"><code>*</code> {{__('lang.max')}} 70 {{__('lang.characters')}} </p>
                                                <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)" />
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('lang.description')}} SEO</label>
                                                <p class="font-13"><code>*</code> {{__('lang.max')}} 320 {{__('lang.characters')}} </p>
                                                <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)"></textarea>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label>{{__('lang.slug')}} <span class="required">*</span></label>
                                                <div class="d-flex form-control">
                                                    <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
                                                    <span>.html</span>
                                                </div>
                                                <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal"
                        aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> {{__('lang.back')}}
                </button>
                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.save')}}
                </button>
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

