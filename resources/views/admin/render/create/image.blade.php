<label>{{__('lang.pic')}}</label>
<div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.4rem">
    <label class="item-input font-weight-medium">
        <input type="file" id="image-upload" class="d-none image-upload" data-target="#image_url"> {{__('lang.select_image')}}
    </label>
</div>
<p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
<div class="dropzone p-2 text-center">
    <div class="dz-message text-center needsclick mb-1" id="image_hidden">
        <label for="image-upload" class="w-100 mb-0">
            <div class="icon-dropzone pt-2">
                <i class="h1 text-muted dripicons-cloud-upload"></i>
            </div>
            <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span>
        </label>
    </div>
    <img src="" alt="" class="rounded mb-1 d-none" id="image_src">
    <div class="input-group">
        <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
        <input type="text" name="data[image]" placeholder="{{__('lang.slug')}}" id="image_url" value="" class="form-control image-src" data-target="#image_src" data-hidden="#image_hidden">
    </div>
</div>
