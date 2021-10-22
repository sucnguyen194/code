<div class="modal-dialog" role="document">
    <form action="{{route('admin.permissions.update',$permission)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permissions #ID{{$permission->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tiêu đề <span class="required">*</span></label>
                    <input type="text" class="form-control" value="{{$permission->title}}" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    <select class="form-control" data-toggle="select2" name="parent_id">
                        <option value="0">-----</option>
                        @foreach($permissions as $item)
                            <option value="{{$item->id}}" {{selected($permission->parent_id, $item->id)}}> {{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-0">
                    <label>Giá trị <span class="required">*</span></label>
                    <input type="text" value="{{$permission->name}}" name="name" required class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>
                <input type="hidden" name="guard" value="admin">
                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại
                </button>
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

