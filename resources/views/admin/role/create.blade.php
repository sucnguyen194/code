<div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 800px" role="document">
    <form action="{{route('admin.roles.store')}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_add_new')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>{{__('_role')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="row">
                    @foreach($permissions->where('parent_id',0) as $key => $permission)
                        <div class="col-md-4 mb-3">
                            <div class="border h-100 p-2">
                                <label class="text-uppercase">{{$permission->title}}</label>
                                @foreach($permissions->where('parent_id',$permission->id) as $parent)
                                    <div class="item-systems">
                                        <div class="checkbox">
                                            <input id="checkbox{{$parent->id}}" type="checkbox"  name="permissions[]" value="{{$parent->id}}">
                                            <label for="checkbox{{$parent->id}}" class="{{$loop->last ? "mb-0" : ""}}"><span class="tree-sub"></span> {{$parent->title}} </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
