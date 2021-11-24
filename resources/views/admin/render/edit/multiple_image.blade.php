<label>{{__('lang.image')}}</label>
<div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:0;top:0">
    <label class="item-input">
        <input type="file" class="d-none" id="slider-file" data-target="#slide-input" multiple> {{__('lang.select_image')}}
    </label>
</div>
<p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
<div class="dropzone pl-2 pr-2 pb-1 float-left w-100">
    <div class="dz-message text-center needsclick mb-2 {{$item->photo ? "d-none" : "d-block"}}" id="remove-label">
        <label for="slider-file" class="w-100 mb-0">
            <div class="icon-dropzone pt-2">
                <i class="h1 text-muted dripicons-cloud-upload"></i>
            </div>
            <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span><br>
            <span class="text-muted font-13">{!! __('lang.note_select_multiple_image') !!}</span>
        </label>
    </div>

    <ul class="slider-holder pl-0 mb-0 w-100 ui-sortable {{$item->photo ? "d-inline-block" : "d-none"}}" id="sortable">
        @if($item->photo)
            @foreach($item->photo as $photo)
                <li class="box-product-images ui-sortable-handle d-inline-block">
                    <div class="item-image rounded position-relative">
                        <div class="img-rounded"><img src="{{$photo}}" class="position-image-product"/></div>
                        <div class="photo-hover-overlay rounded">
                            <input name="photos[]" type="hidden" value="{{$photo}}">
                            <div class="box-hover-overlay">
                                <a title="{{__('lang.detail')}}" data-image="{{$photo}}" data-toggle="modal" data-target="#viewImage" class="tooltip-hover view-image text-white">
                                    <i class="far fa-eye"></i>
                                </a>
                                {{--                                                <a class="tooltip-hover pl-2 text-white" v-on:click="getAlt(item.id)" data-target="#updateALT" data-toggle="modal" title="Sửa ALT">--}}
                                {{--                                                    ALT--}}
                                {{--                                                </a>--}}
                                <a class="tooltip-hover pl-2 text-white" id="slider-delete" title="{{__('lang.destroy')}}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>

</div>
