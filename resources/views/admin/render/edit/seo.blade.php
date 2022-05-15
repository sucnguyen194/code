<div class="d-flex mb-2">
    <label class="font-weight-bold">{{__('lang.optimization')}} {{__('lang.seo')}}</label>
    <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo font-weight-medium">{{__('_edit')}} {{__('lang.seo')}}</a>
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
        <label>{{__('_title')}}</label>
        <p class="font-13"><code>*</code> {{__('lang.max')}} 70 {{__('lang.characters')}} </p>
        <input type="text" maxlength="70" name="translation[{{$key}}][title_seo]" class="form-control" id="alloptions" value="{{$translation->title_seo}}" language="title_seo_{{$translation->locale}}" onkeyup="changeToTitleSeo(this)" />
    </div>
    <div class="form-group">
        <label>{{__('_description')}}</label>
        <p class="font-13"><code>*</code> {{__('lang.max')}} 320 {{__('lang.characters')}} </p>
        <textarea  class="form-control" rows="3" name="translation[{{$key}}][description_seo]" maxlength="320" id="alloptions" language="description_seo_{{$translation->locale}}" onkeyup="changeToDescriptionSeo(this)">{{$translation->description_seo}}</textarea>
    </div>
    <div class="form-group mb-0">
        <label>{{__('_slug')}} <span class="required">*</span></label>
        <div class="d-flex form-control">
            <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{$translation->language->name}}" onkeyup="ChangeToSlug(this);"name="translation[{{$key}}][slug]">
            <span>.html</span>
        </div>
        <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
    </div>
</div>
