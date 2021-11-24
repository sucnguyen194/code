<div class="media">
    <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
        <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
            <img src="{{$item->background}}" class="background_src {{!$item->background ? "d-none" : ""}}" id="background_src" width="100%"
                 height="100%">
        </div>
    </div>
    <div class="media-body ml-3">
        <label class="form-label">{{__('lang.background')}}</label>
        <div class="form-group">
            <div class="input-group">
                <input name="data[background]" id="background_url" value="{{$item->background}}" data-target="#background_src"
                       type="text" class="form-control background_url" placeholder="http://">
                <span class="input-group-append">
                                                 <label class="btn btn-default" type="button"><input type="file"
                                                                                                     class="d-none background-upload"
                                                                                                     id="background-upload"
                                                                                                     data-target="#background_url">{{__('lang.upload')}}...</label>
                                            </span>
            </div>
        </div>
    </div>
</div>
