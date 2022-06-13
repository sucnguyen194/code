<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.languages.update.item.translate', $lang)}}" class="ajax-form w-100" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('_translate')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="basic-addon1" class="input-group-text">{{$key}}</span>
                    </div>
                    <input type="text" class="form-control"  name="value" value="{{$value}}">
                    <input type="hidden" class="form-control"  name="key" value="{{$key}}">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>

