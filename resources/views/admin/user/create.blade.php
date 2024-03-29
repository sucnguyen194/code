<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.users.store')}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
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
                    <label for="name">{{__('_fullname')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">{{__('_email')}} <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]"  value="">
                </div>
                <div class="form-group">
                    <label for="password">{{__('_password')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required >
                </div>

                <div class="form-group">
                    <label for="phone">{{__('_phone')}}</label>
                    <input type="tel" class="form-control" id="phone" name="data[phone]" value="">
                </div>
                <div class="form-group">
                    <label for="address">{{__('_address')}}</label>
                    <input name="data[address]" id="address" class="form-control" value="">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
