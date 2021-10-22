<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.users.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="name" name="data[name]" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="data[email]"  value="">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu <span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required >
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" class="form-control" id="phone" name="data[phone]" value="">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input name="data[address]" id="address" class="form-control" value="">
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
