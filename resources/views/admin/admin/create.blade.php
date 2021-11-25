<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.admins.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.account'))}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('lang.name')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" required value="">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]" required value="">
                </div>
                <div class="form-group">
                    <label for="password">{{__('lang.password')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required placeholder="******">
                </div>
                <div class="form-group mb-0">
                    <label for="roles">{{__('lang.role')}}</label>
                    <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="roles[]" data-placeholder="{{__('lang.note_select_many_role')}}">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> {{__('lang.back')}}
                </button>

                <button type="submit" class="btn btn-primary waves-effect waves-light float-right" name="send"
                        value="save"><span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.save')}}
                </button>
            </div>
        </div>
    </form>
</div>
<style>
    .select2-search__field, .select2-search {
        width: 100%!important;
    }
</style>
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

