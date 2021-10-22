<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{setting('site.name.'.session('lang'))}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{setting('site.favicon')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Vendor js -->
    <script src="/lib/assets/js/vendor.min.js"></script>
    <!-- Tost-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

    <!-- App css -->
    <link href="/lib/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/lib/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/lib/assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

<div class="home-btn d-none d-sm-block">
    <a href="/"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">

                    <div class="card-body p-4">

                        <div class="account-box">
                            <div class="account-logo-box">
{{--                                <div class="text-center">--}}
{{--                                    <a href="#">--}}
{{--                                        <img src="/lib/assets/images/logo-dark.png" alt="" height="30">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <h5 class="text-uppercase mb-1 mt-0">Đăng nhập</h5>
                                <p class="mb-0">{{setting('site.note.maintenance')}}</p>
                            </div>

                            <div class="account-content mt-4">
                                <div class="text-center mb-3">
                                    <div class="mb-3">
                                        @if(setting('site.logo'))
                                        <img src="{{setting('site.logo')}}" height="30" class="" alt="thumbnail">
                                        @else
                                            <img src="/lib/assets/images/logo-dark.png"  height="30" class="" alt="thumbnail">
                                        @endif
                                    </div>

                                    <p class="text-muted mb-0 font-13">Nhập mật khẩu của bạn để truy cập quản trị viên</p>
                                </div>

                                <form class="form-horizontal ajax-form" action="{{route('maintenance')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="password">Mật khẩu</label>
                                            <input class="form-control" type="password" name="password" required="" id="password" placeholder="Nhập mật khẩu của bạn!">
                                        </div>
                                    </div>

                                    <div class="form-group row text-center mb-0 mt-2">
                                        <div class="col-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Đăng nhập</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->
@include('errors.note')

<!-- App js -->
<script src="/lib/assets/js/app.min.js"></script>

<script src="/lib/js/cpanel.js"></script>
<style>
    .btn-primary:hover {
        background: -webkit-gradient(linear,left top,left bottom,from(#0078bd),to(#0377b9));
        background: linear-gradient(to bottom,#0078bd,#0377b9);
        border-color: #065f92;
        -webkit-box-shadow: inset 0 1px 0 0 #0078bd;
        box-shadow: inset 0 1px 0 0 #0078bd;
        color: #fff;
        outline: none;
    }
</style>

<script type="text/javascript">
    // Ajax form
    function ajaxform(ele){

        $(ele).ajaxSubmit({
            headers: {
                "X-CSRF-Token": $('meta[name=_token]').attr('content')
            },
            beforeSubmit:function(formData, jqForm, options){
                $(ele).find('[type=submit]').attr('disabled', true);

            },
            success: function(responseText, statusText, xhr, $form) {


            },
            error: function(xhr, status, errMsg, $form) {

            },
            complete: function(xhr, statusText, $form  ){

                $(ele).find('[type=submit]').attr('disabled', false);

                let result = xhr.responseText;

                try{
                    result = $.parseJSON(result);
                }catch{
                    console.log('invalid json response');
                    $('#ajax-modal').html(result).modal();
                    return;
                }

                flash(result);

                if(result.type=='success' || result.type=='info'){

                    if($form.data('reset')==true)
                        $form.resetForm();

                    $('#ajax-modal').modal('hide');

                    try{
                        $table.bootstrapTable('refresh',{silent: true});
                    }catch{}
                }

            }

        });
        return false;
    }
    $(document).on('submit','.ajax-form',function(e){
        e.preventDefault();

        ajaxform(this);
        return false;
    });
</script>

</body>

</html>
