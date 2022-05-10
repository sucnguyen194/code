<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.languages.import.translate')}}" class="ajax-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('_import_language')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center text-danger">@lang('_import_language_note')</p>
                <div class="input-group">
                    <label for="key" class="font-weight-bold">@lang('_key')</label>

                    <select class="form-control select2" name="from" data-placeholder="@lang('_import_keywords')">
                        <option value=""></option>
                        @foreach($languages as $language)
                        <option value="{{$language->value}}">{{$language->name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" value="{{$to}}" name="to">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>

