<div class="modal-dialog" role="document">
    <form action="{{route('admin.permissions.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_permission'))}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>{{__('lang.title')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" value="{{old('title')}}" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label>{{__('lang.group')}}</label>
                    <select class="form-control" data-toggle="select2" name="parent_id">
                        <option value="0">-----</option>
                        @foreach($permissions as $item)
                            <option value="{{$item->id}}" {{old('parent_id') == $item->id  ? "selected" : ""}}> {{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-0">
                    <label>{{__('_value')}} <span class="required">*</span></label>
                    <input type="text" value="{{old('name')}}" name="name" required class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: $(this).data('placeholder'),
                });
            });
        })

    </script>

