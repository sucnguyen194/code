<div class="form-group">
    <label>{{__('_slug')}} <span class="required">*</span></label>
    <div class="d-flex form-control">
        <span>{{route('home')}}/</span><input type="text" class="border-0 slug" id="{{$language->value}}" value="{{old('data.alias')}}" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][slug]">
        <span>.html</span>
    </div>
    <input type="hidden" name="translation[{{$key}}][locale]" value="{{$language->value}}">
</div>
