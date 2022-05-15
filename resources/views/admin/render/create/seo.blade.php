<div class="d-flex mb-2">
    <label class="font-weight-bold">{{__('_optimization_seo')}}</label>
    <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo font-weight-medium">{{__('_edit_seo')}}</a>
</div>

<p class="font-13">{{__('_note_seo')}}</p>
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
        <label>{{__('_title')}}</label>
        <p class="font-13"><code>*</code> {{__('_max')}} 70 {{__('_characters')}} </p>
        <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)" />
    </div>
    <div class="form-group">
        <label>{{__('_description')}}</label>
        <p class="font-13"><code>*</code> {{__('_max')}} 320 {{__('_characters')}} </p>
        <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)"></textarea>
    </div>

    <div class="form-group mb-0">
        <label>{{__('_slug')}} <span class="required">*</span></label>
        <div class="d-flex form-control">
            <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
{{--            <span>.html</span>--}}
        </div>
        <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
    </div>
</div>
