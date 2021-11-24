<div class="form-group">
    <label>{{__('lang.slug')}} <span class="required">*</span></label>
    <div class="d-flex form-control">
        <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$translation->locale}}" value="{{$translation->slug}}" language="{{$translation->locale}}" seo="{{optional($translation->language)->name}}" onkeyup="ChangeToSlug(this);"name="translation[{{$key}}][slug]">
        <span>.html</span>
    </div>
    <input type="hidden" name="translation[{{$key}}][locale]" value="{{$translation->locale}}">
</div>
