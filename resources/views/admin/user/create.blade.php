<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.users.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.customer'))}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('lang.fullname')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">{{__('lang.email')}} <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]"  value="">
                </div>
                <div class="form-group">
                    <label for="password">{{__('lang.password')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required >
                </div>

                <div class="form-group">
                    <label for="phone">{{__('lang.phone')}}</label>
                    <input type="tel" class="form-control" id="phone" name="data[phone]" value="">
                </div>
                <div class="form-group">
                    <label for="address">{{__('lang.address')}}</label>
                    <input name="data[address]" id="address" class="form-control" value="">
                </div>
            </div>
            <div class="modal-footer">
                @include('admin.render.modal')
            </div>
        </div>
    </form>
</div>
