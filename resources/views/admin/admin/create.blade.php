<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.admins.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
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
                    <label for="name">Họ và tên <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="data[name]" required value="{{old('data.name')}}" placeholder="Nguyễn Văn A">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]" required value="{{old('data.email')}}" placeholder="nguyenvan@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required placeholder="******">
                </div>
                <div class="form-group mb-0">
                    <label for="roles">Chức vụ</label>
                    <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="roles[]" data-placeholder="Không">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
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

<script type="text/javascript">
    $('#image-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let target = $(this).data('target');

        let formData = new FormData();
        formData.append('image', file);

        fetch(
            "https://api.imgur.com/3/image",
            {
                method: "POST",
                body: formData,
                "headers": {
                    "Authorization": "Client-ID {{ setting('api.imgur_client_id') }}"
                },
            }
        )
            .then(response => response.json())
            .then(result => {
                $(target).val(result.data.link).trigger('change');
            })
            .catch(error => {
                alert('Lỗi upload: '+error)
                console.error("Error:", error);
            });

    });

    $('#image_url').on('change', function (){
        let target = $(this).data('target');
        let  hidden = $(this).data('hidden');
        if ($(this).val()){
            $(target).removeClass('d-none').attr('src', $(this).val()).show();
            $(hidden).hide();
        }else{
            $(target).hide();
            $(hidden).removeClass('d-none').show();
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        let editor = $('.summernote, .summerbody');

        $(editor).each(function (index) {
            let ele = $(this)[0];
            let height = $(this).data('height');
            editors(ele, height);
        })
        $('select').each(function () {

            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });
    })

</script>

