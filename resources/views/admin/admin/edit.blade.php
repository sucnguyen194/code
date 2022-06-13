<div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form action="{{route('admin.admins.update',$admin)}}" method="post" class="ajax-form w-100" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('_account')}} #{{$admin->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('_name')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" required value="{{$admin->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]" required value="{{$admin->email}}">
                </div>
                <div class="form-group">
                    <label for="password">{{__('_password')}}</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="******">
                </div>
                <div class="form-group mb-0">
                    <label for="roles">{{__('_role')}}</label>
                    <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="roles[]" data-placeholder="{{__('lang.note_select_many_role')}}">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ selected($role->id, optional($admin->roles)->pluck('id')->toArray()) }}>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> {{__('_back')}}
                </button>

                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> {{__('_save')}}
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
