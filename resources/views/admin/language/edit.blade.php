<div class="modal-dialog modal-md" role="document">
    <form action="{{route('admin.languages.update',$language)}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ngôn ngữ #ID{{$language->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Danh sách ngôn ngữ hiện tại <span class="required">*</span></label>
                    @foreach($languages as $item)
                        <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer"><cite title="{{$item->name}} ({{$item->value}})" class="font-weight-bold">{{$item->name}} ({{$item->value}})</cite></footer>
                        </blockquote>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Tên ngôn ngữ <span class="required">*</span></label>
                    <p>* Ghi chú: tên ngôn ngữ phải khác nhau</p>
                    <input type="text" class="form-control" value="{{$language->name}}" name="name" required>
                </div>
                <div class="form-group">
                    <label>Giá trị <span class="required">*</span></label>
                    <p>* Ghi chú: Giới hạn tối đa 2 ký tự</p>
                    <input type="text" maxlength="2" value="{{$language->value}}" name="value" class="form-control" id="alloptions" />
                </div>

                <div class="form-group position-relative">
                    <div class="media">
                        <div class="thumbnail-container square" style="border: 1px dashed #ddd;">
                            <div style="width: 100px; height: 100px; border: 1px solid #ddd;">
                                <img src="{{$language->image}}" class="image_src {{!$language->image ? "d-none" : ""}}" id="image_src" width="100%" height="100%">
                            </div>
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">Icon</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="image" id="image_url" data-target="#image_src" value="{{$language->image}}"  type="text" class="form-control" placeholder="http://">
                                    <span class="input-group-append">
                                 <label class="btn btn-default" type="button"><input type="file" class="d-none image-upload" id="image-upload" data-target="#image_url" >Upload..</label>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="{{asset('lib/assets/js/pages/form-advanced.init.js')}}"></script>
<script type="text/javascript">
    $('#image-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        if (!file)
            return false;

        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': 'API IMG chưa được cấu hình!', 'type': 'error'});

        let target = $(this).data('target');

        let formData = new FormData();
        formData.append('image', file);
        $('.loading').fadeIn()
        fetch(
            "https://api.imgur.com/3/image",
            {
                method: "POST",
                body: formData,
                "headers": {
                    "Authorization": "Client-ID "+ imgur_client_id
                },
            }
        )
            .then(response => response.json())
            .then(result => {
                $(target).val(result.data.link).trigger('change');
                $('.loading').fadeOut();
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
