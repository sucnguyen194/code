<label>{{__('lang.image')}}</label>
<div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:0;top:0">
    <label class="item-input mb-0">
        <input type="file" class="d-none" id="slider-file" data-target="#slide-input" multiple> {{__('lang.select_image')}}
    </label>
</div>
<p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
<div class="dropzone pl-2 pr-2 pb-1">
    <div class="dz-message text-center needsclick mb-1" id="remove-label">
        <label for="slider-file" class="w-100 mb-0">
            <div class="icon-dropzone pt-2">
                <i class="h1 text-muted dripicons-cloud-upload"></i>
            </div>
            <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span><br>
            <span class="text-muted font-13">{!! __('lang.note_select_multiple_image') !!}</span>

        </label>
    </div>

    <ul class="slider-holder d-none pl-0 mb-0 w-100" id="sortable">

    </ul>
</div>
