<div class="media">
    <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
        <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
            <img src="" class="image_src d-none" id="image_src" width="100%" height="100%">
        </div>
    </div>
    <div class="media-body ml-3">
        <label class="form-label">{{__('lang.pic')}}</label>
        <div class="form-group">
            <div class="input-group">
                <input name="data[image]" id="image_url" data-target="#image_src"  type="text" class="form-control image_url" placeholder="http://">
                <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >{{__('lang.upload')}}...</label>
                            </span>
            </div>
        </div>
    </div>
</div>
