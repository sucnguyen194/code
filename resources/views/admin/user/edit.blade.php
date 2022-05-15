<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.users.update',$user)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_customer')}} #{{$user->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('_fullname')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <label for="email">{{__('_email')}} <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]"  value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">{{__('_password')}} </label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="phone">{{__('_phone')}}</label>
                    <input type="tel" class="form-control" id="phone" name="data[phone]" value="{{$user->phone}}">
                </div>
                <div class="form-group">
                    <label for="address">{{__('_address')}}</label>
                    <input name="data[address]" id="address" class="form-control" value="{{$user->address}}">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
