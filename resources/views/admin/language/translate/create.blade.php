<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.languages.create.translate', $lang)}}" class="ajax-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('_add_new')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('_key')</label>
                    <input type="text" value="" name="key" class="form-control">
                </div>
                <div>
                    <label>@lang('_value')</label>
                    <input type="text" value="" name="value" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>

