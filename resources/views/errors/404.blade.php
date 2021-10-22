<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>404 Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('lib/assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('lib/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('lib/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

<div class="home-btn d-none d-sm-block">
    <a href="{{route('home')}}"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">
                    <div class="card-body p-4">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <div class="text-center">
                                    <a href="{{route('home')}}">
                                        <img src="{{asset('lib/assets/images/logo-dark.png')}}" alt="" height="30">
                                    </a>
                                </div>
                            </div>
                            <div class="account-content text-center mt-4">
                                <h1 class="text-error">404</h1>
                                <h3 class="text-uppercase text-danger mt-4">Page Not Found</h3>
                                <p class="text-muted mt-3">It's looking like you may have taken a wrong turn. Don't worry... it
                                    happens to the best of us. You might want to check your internet connection. Here's a
                                    little tip that might help you get back on track.</p>

                                <a class="btn btn-md btn-block btn-primary waves-effect waves-light mt-3" href="{{route('home')}}"> Return Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{asset('lib/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('lib/assets/js/app.min.js')}}"></script>

</body>

</html>