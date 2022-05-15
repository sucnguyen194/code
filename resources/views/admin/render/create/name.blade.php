<div class="form-group">
    <label>{{__('_product')}} <span class="required">*</span></label>
    <input type="text" class="form-control" language="{{$language->value}}" seo="{{$language->name}}" onkeyup="ChangeToSlug(this);" name="translation[{{$key}}][name]" >
</div>
