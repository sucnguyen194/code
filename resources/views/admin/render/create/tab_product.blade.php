<ul class="nav nav-tabs tabs-bordered">
    <li class="nav-item">
        <a href=".description" data-toggle="custom" aria-expanded="false"
           class="nav-link active">
            <span class="d-block">{{__('_description')}}</span>
        </a>
    </li>

    <li class="nav-item">
        <a href=".content" data-toggle="custom" aria-expanded="false"
           class="nav-link">
            <span class="d-block">{{__('_content')}}</span>
        </a>
    </li>

</ul>
<div class="tab-content h-100">
    <div class="tab-custom tab-pane description active">
        <textarea class="form-control summernote"  rows="7" data-height="500" id="summernote" name="translation[{{$key}}][description]"></textarea>
    </div>

    <div class="tab-custom tab-pane content">
        <textarea class="form-control summernote" data-height="500" id="summerbody" name="translation[{{$key}}][content]"></textarea>
    </div>
</div>
