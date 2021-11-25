<label>{{__('lang.image')}}</label>
<div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:0;top:0">
    <label class="item-input font-weight-medium mb-0">
        <input type="file" class="d-none" id="slider-file" data-target="#slide-input" multiple> {{__('lang.select_image')}}
    </label>
</div>
<p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
<div class="dropzone pl-2 pr-2 pb-1">
    <div class="dz-message text-center needsclick mb-1" id="remove-label">
        <label for="slider-file" class="w-100 mb-0">
          @include('admin.render.note_image')
        </label>
    </div>

    <ul class="slider-holder d-none pl-0 mb-0 w-100" id="sortable">

    </ul>
</div>
