<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta http-equiv="content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta charset="utf-8">
  <title>@hasSection('title') @yield('title') - @endif {{setting('site.name.'.session('lang'))}}</title>
  <meta name="keywords" content="@yield('keywords',setting('site.keyword_seo.'.session('lang')))"/>
  <meta name="description" content="@yield('description',setting('site.description_seo.'.session('lang')))"/>
  <meta property="og:url" content="@yield('url', url('/'))" />
  <meta property="og:title" content="@hasSection('title') @yield('title') - @endif {{setting('site.name.'.session('lang'))}}" />
  <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
  <meta property="og:type" content="website" />
    @if(setting('api.facebook_app_ip'))
  <meta property="fb:app_id" content="{{setting('api.facebook_app_ip')}}" />
    @endif
  <meta property="og:description" content="@yield('description',setting('site.description_seo.'.session('lang')))" />
  <meta property="og:image" content="@yield('image', setting('site.og_image') ?? setting('site.logo'))" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  <meta property="og:image:alt" content="@hasSection('title') @yield('title') - @endif {{setting('site.name.'.session('lang'))}}" />
  <meta property="og:site_name" content="@hasSection('title') @yield('title') - @endif {{setting('site.name.'.session('lang'))}}" />
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:description" content="@yield('description',setting('site.description_seo.'.session('lang')))"/>
  <meta name="twitter:title" content="@hasSection('title') @yield('title') - @endif {{setting('site.name.'.session('lang'))}}"/>
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="@yield('url', url('/'))">
  <link rel="icon" href="{{asset(setting('site.favicon'))}}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <!--*************************---->
  <base href="{{route('home')}}">

  <!-- Latest compiled and minified CSS & JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" integrity="sha512-3PN6gfRNZEX4YFyz+sIyTF6pGlQiryJu9NlGhu9LrLMQ7eDjNgudQoFDK3WSNAayeIKc6B8WXXpo4a7HqxjKwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
{{--    <!-- Vendor js -->--}}
{{--    <script src="/lib/assets/js/vendor.min.js"></script>--}}
    <link rel="stylesheet"
          href="//fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C500%2C600%2C700%2C800%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik"/>
    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/assetsfw/vendor/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/icon-line/css/simple-line-icons.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/icon-line-pro/style.css"/>
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/assetsfw/vendor/icon-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/icon-hs/style.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/hamburgers/hamburgers.min.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/hs-megamenu/src/hs.megamenu.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" href="/assetsfw/vendor/fancybox/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="/assets/masterslidejs/masterslider.main.css"/>
    <!-- CSS Template -->
    <link rel="stylesheet" href="/assetsfw/css/unify-core.css"/>
    <link rel="stylesheet" href="/assetsfw/css/unify-components.css"/>
    <link rel="stylesheet" href="/assets/css/styles.op-tamloi.css"/>
    <!-- CSS Customization -->
    <link rel="stylesheet" href="/assetsfw/css/custom.css"/>
    <!--*********************************---->
    {!! setting('site.remarketing_header') !!}

</head>
<body>
    <div id="app-body">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
    {!! setting('site.remarketing_footer') !!}

  </body>
  <!--************START*************---->

<!-- Vendor js -->
{{--<script src="{{asset('lib/assets/js/vendor.min.js')}}"></script>--}}
<!-- rating js -->
<script src="https://coderthemes.com/adminox/layouts/vertical/assets/libs/ratings/jquery.raty-fa.js"></script>
<!-- Tost-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@include('errors.note')

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


<script src="/lib/js/cpanel.js"></script>

<style>
    .image-style-align-left {
        float: left;
    }
    .image-style-align-right, .image-style-side {
        float: right;
    }
    .image-style-align-center {
        text-align: center;
    }
    .image-style-block-align-right {
        margin-right: 0;
        margin-left: auto;
    }
    .image-style-block-align-left {
        margin-left: 0;
        margin-right: auto;
    }
</style>
  <!--*************************---->
{{--<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>--}}
{{--<script type="text/javascript">--}}
{{--    let alias = $('.vue-alias').val();--}}
{{--    // let amount = $('#quantity').val();--}}
{{--    var app = new Vue({--}}
{{--        el: '#app-body',--}}
{{--        mounted:function(){--}}
{{--            var vm = this;--}}
{{--        },--}}
{{--        data:{--}}
{{--            alias: alias,--}}
{{--            carts: @json(Cart::content()),--}}
{{--            lang: {--}}
{{--                type: 0,--}}
{{--                id: 0,--}}
{{--                lang:0,--}}
{{--            },--}}
{{--            cart: {--}}
{{--                total: "{{Cart::subtotal(0)}}",--}}
{{--                count: {{Cart::content()->count()}},--}}
{{--            },--}}
{{--            amount: 1,--}}
{{--            options:[]--}}
{{--        },--}}
{{--        methods: {--}}
{{--            plusQuantity:function(){--}}
{{--                if ( jQuery('input[name="quantity"]').val() != undefined ) {--}}
{{--                    var currentVal = parseInt(jQuery('input[name="quantity"]').val());--}}
{{--                    if (!isNaN(currentVal)) {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(currentVal + 1);--}}
{{--                    } else {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(1);--}}
{{--                    }--}}
{{--                    app.amount = amount.val();--}}
{{--                }else {--}}
{{--                    console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());--}}
{{--                }--}}
{{--                console.log(amount);--}}
{{--            },--}}
{{--            minusQuantity:function(){--}}
{{--                if ( jQuery('input[name="quantity"]').val() != undefined ) {--}}
{{--                    var currentVal = parseInt(jQuery('input[name="quantity"]').val());--}}
{{--                    if (!isNaN(currentVal) && currentVal > 1) {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(currentVal - 1);--}}
{{--                        app.amount = amount.val();--}}
{{--                    }--}}
{{--                }else {--}}
{{--                    console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());--}}
{{--                }--}}
{{--            },--}}
{{--            changelang:function(lang){--}}
{{--                fetch("{{route('ajax.change.lang',[':alias',':lang'])}}".replace(":alias", this.alias).replace(":lang", lang)).then(function(response){--}}
{{--                    return response.json().then(function(data){--}}
{{--                        window.location.assign(data);--}}
{{--                    })--}}
{{--                })--}}
{{--            },--}}
{{--            buyNow:function(id, qty =1, options = null){--}}
{{--                let route = "{{route('ajax.order.create',[":id", ":qty",':options'])}}".replace(":id",id).replace(":qty",qty).replace(":options",options);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        let checkout = "{{route('orders.checkout')}}";--}}
{{--                        window.location.assign(checkout);--}}
{{--                    })--}}
{{--                })--}}
{{--            },--}}
{{--            orderCreate:function(id, qty = 1, options = null){--}}
{{--                let route = "{{route('ajax.order.create',[":id", ":qty",':options'])}}".replace(":id",id).replace(":qty",qty).replace(":options",options);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        app.carts = data.carts;--}}
{{--                        app.cart.total = data.total;--}}
{{--                        app.cart.count = data.count;--}}
{{--                        // let obj = {--}}
{{--                        //     'message' : "Thêm thành công sản phẩm vào giỏ hàng!",--}}
{{--                        //     'type' : "success"--}}
{{--                        // }--}}
{{--                        // flash(obj);--}}
{{--                    })--}}
{{--                })--}}
{{--            },--}}
{{--            orderRemove:function(rowId){--}}
{{--                if(confirm('Xóa sản phẩm?')){--}}
{{--                    let route = "{{route('ajax.order.remove',":rowId")}}".replace(":rowId",rowId);--}}
{{--                    fetch(route).then(function (res) {--}}
{{--                        return res.json().then(function (data) {--}}
{{--                            app.carts = data.carts;--}}
{{--                            app.cart.total = data.total;--}}
{{--                            app.cart.count = data.count;--}}
{{--                        })--}}
{{--                    })--}}
{{--                }--}}
{{--            },--}}
{{--            orderUpdate:function(rowId, qty){--}}
{{--                let route = "{{route('ajax.order.update',[":rowId",":qty"])}}".replace(":rowId",rowId).replace(":qty",qty);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        app.carts = data.carts;--}}
{{--                        app.cart.total = data.total;--}}
{{--                        app.cart.count = data.count;--}}
{{--                        let obj = {--}}
{{--                            'message' : "Cật nhật thành công!",--}}
{{--                            'type' : "success"--}}
{{--                        }--}}
{{--                        flash(obj);--}}
{{--                    })--}}
{{--                })--}}
{{--            }--}}
{{--        },--}}
{{--        watch: {--}}
{{--            alias:function(val){--}}
{{--                this.alias = val;--}}
{{--            },--}}
{{--            amount:function(val){--}}
{{--                this.amount = val;--}}
{{--            }--}}
{{--        },--}}
{{--        computed:{--}}

{{--        }--}}
{{--    })--}}
{{--</script>--}}
<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').on('change', function() {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);

            let input = $('input[target=options]:checked');
            let options = [];
            $(options).empty();
            $.each(input, function(index,option){
                options.push($(option).val());
            });
            console.log(options);
        });
    });
</script>

<script>

    function flash(obj){


        if(obj.hasOwnProperty('errors')){
            $.each( obj.errors, function( key, value ) {
                toastr['error'](value);
            });
        }else if(obj.type){

            toastr[obj.type](obj.message);
        }else if(obj.message){
            toastr['error'](obj.message);
        }else
            toastr['warning']('Đã có lỗi xảy ra');

        if (obj.hasOwnProperty('url') && (obj.url!=null && obj.url!='')){
            window.open(obj.url, obj.target)
        }

    }


    // // Flash message
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "opacity": "1",
        "timeOut": "6000",
        "extendedTimeOut": "4000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

</script>

<!--*************************---->

<!--****STARTACTION CALL*****---->
{{--<div class="action-call">--}}
{{--  <div id="phonering-alo-phoneIcon" class="phonering-alo-phone phonering-alo-green phonering-alo-show">--}}
{{--    <div class="phonering-alo-ph-circle"></div>--}}
{{--    <div class="phonering-alo-ph-circle-fill"></div>--}}
{{--    <div class="phonering-alo-ph-img-circle">--}}
{{--      <a class="pps-btn-img " href="tel:"> <img src="https://wonderads.vn/themes/default/images/v8TniL3.png" alt="Liên hệ" width="50" class="img-responsive"/> </a>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}
<!--*****END ACTION CALL*****---->


@if(setting('api.chat_message_id'))
<div class="fb-customerchat" page_id="{{setting('api.chat_message_id')}}" greeting_dialog_delay="30" logged_in_greeting="{{setting('api.chat_message_text')}} " logged_out_greeting="{{setting('api.chat_message_text')}} "></div>

<div id='fb-root'></div>
<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v6.0'
        });
    };

    window.addEventListener('load', function() {
        var is_load = 0
        function loadfb() {
            if (is_load == 0) {
                is_load = 1
                var an = document.createElement('script')
                an.async = true;
                an.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1'
                var sc = document.getElementsByTagName('script')[0]
                sc.parentNode.insertBefore(an, sc)
            }
        }
        window.addEventListener('scroll', function() {
            loadfb()
        })
        setTimeout(function(){loadfb()},5000)
    });
</script>
@endif

@if(setting('api.google_analytics_id'))
<script type="text/javascript">
    window.addEventListener('load', function() {
        var is_load = 0

        function loadanalytics() {
            if (is_load == 0) {
                is_load = 1
                var an = document.createElement('script')
                an.async = true;
                an.src = 'https://www.googletagmanager.com/gtag/js?id={{setting('api.google_analytics_id')}}'
                var sc = document.getElementsByTagName('script')[0]
                sc.parentNode.insertBefore(an, sc)
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', '{{setting('api.google_analytics_id')}}');
            }
        }
        window.addEventListener('scroll', function() {
            loadanalytics()
        })
        setTimeout(function(){loadanalytics()},3000)
    })
</script>
@endif
</html>
