<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.languages.update.translate', $lang)}}" class="ajax-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('edit')</h5>
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

