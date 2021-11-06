<div class="modal-dialog modal-lg" style="max-width: 800px" role="document">
    <form action="{{route('admin.roles.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Chức vụ <span class="required">*</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="row">
                    @foreach($permissions->where('parent_id',0) as $key => $permission)
                        <div class="col-md-4">
                            <div class="border h-100 p-2">
                                <label class="text-uppercase">{{$permission->title}}</label>
                                @foreach($permissions->where('parent_id',$permission->id) as $parent)
                                    <div class="item-systems">
                                        <div class="checkbox">
                                            <input id="checkbox{{$parent->id}}" type="checkbox"  name="permissions[]" value="{{$parent->id}}">
                                            <label for="checkbox{{$parent->id}}"><span class="tree-sub"></span> {{$parent->title}} </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>

                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại
                </button>
            </div>
        </div>
    </form>
</div>
