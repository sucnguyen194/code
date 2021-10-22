@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->post->image}} @stop
@section('content')
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
<main class="main-site">
    <div class="home-site">
        <div class="main-container">
            <div class="container">
                <div class="w-xs-100 w-75 m-auto">
                    <article class="art-categories pt-4 pb-2">
                        <div class="slick-slider slick-categories">
                            @foreach(\App\Models\Category::whereType(\App\Enums\CategoryType::PRODUCT_CATEGORY)->public()->status()->oldest('sort')->latest()->get() as $category)
                                <div class="item">
                                    <div class="categories-box">
                                        <div class="categories-image">
                                            <a href="{{route('alias',$category->alias)}}"><img src="{{asset($category->image)}}" alt="{{$category->name}}"> </a>
                                        </div>
                                        <div class="categories-content text-center">
                                            <h4 class="categories-name">
                                                <a href="{{route('alias',$category->alias)}}">{{$category->name}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
            <!--art categories -->

        {{--                <article class="art-breadcrumbs">--}}
        {{--                    <div class="container">--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
        {{--                                <div class="breadcrumbs-content">--}}
        {{--                                    <div class="content-box content-breadcrumb">--}}
        {{--                                        <ul class="breadcrumb-box mb-3">--}}
        {{--                                            <li> <a href="/" title="Trang chủ">Thứ ... ngày {{date('d', time())}} tháng {{date('m', time())}} năm {{date('Y', time())}}</a> </li>--}}
        {{--                                            <li> <span>Trang chủ</span> </li>--}}
        {{--                                        </ul>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </article>--}}
        <!--breadcrumbs-->

            <article class="art-slidershow-posts">
                <div class="container">
                    <div class="box-slider w-75 m-auto">
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-lg-0 mb-3">
                                <div class="category-name text-center mt-4">
                                    <h1>{{$category->name ?? "N/A"}}</h1>
                                </div>
                                <div class="description-category mb-4 text-right">
                                   {!! $cate->description !!}
                                </div>
                                <div class="form-category d-none">
                                    <div class="row">
                                        <div class="col-lg-6 text-center">
                                            <div class="mt-2">
                                                <p>Xem bảng giá <a href="" class="">TẠI ĐÂY</a> </p>

                                                <label class="btn btn-default" for="send-image">
                                                    <input type="file" class="d-none" id="send-image">
                                                    Gửi ảnh
                                                </label>
                                            </div>
                                            <div class="mb-2">
                                                <input class="form-control" type="text" placeholder="Họ & tên *" required>
                                            </div>
                                            <div class="mb-2">
                                                <input class="form-control" type="tel" placeholder="Số điện thoại *" required>
                                            </div>
                                            <div class="mb-2">
                                                <input class="form-control" type="text" placeholder="Địa chỉ *" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-lg-5 text-right">Số trang</div>
                                                    <div class="col-lg-7">
                                                        <select class="form-control w-100">
                                                            <option value="0">----</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-lg-5 text-right">Kích thước</div>
                                                    <div class="col-lg-7">
                                                        <select class="form-control w-100">
                                                            <option value="0">----</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-lg-5 text-right">Bìa</div>
                                                    <div class="col-lg-7">
                                                        <select class="form-control w-100">
                                                            <option value="0">----</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-lg-5 text-right">Gáy đóng</div>
                                                    <div class="col-lg-7">
                                                        <select class="form-control w-100">
                                                            <option value="0">----</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-lg-5 text-right">Số lượng</div>
                                                    <div class="col-lg-7">
                                                        <select class="form-control w-100">
                                                            <option value="0">----</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="button">
                                                <button type="submit" class="btn btn-default">Đặt hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 category-image d-none">
                                <img src="{{asset($cate->image)}}" class="w-100" style="height: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="products-col mb-5">
                <div class="container">
                    <div class="w-xs-100 w-75 m-auto">
                        <div class="row">
                            @foreach($products as $item)
                            <div class="product-item col-lg-4">
                                @include('Include.item-product')
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>

            <article class="menu-home mb-5">
                <div class="container">
                    <div class="w-xs-100 w-75 m-auto">
                        <div class="row">
                            @foreach(\App\Models\Menu::home()->oldest('sort')->whereParentId(0)->get() as $key => $bottom)
                                <div class="col-lg-2 col-4 text-center {{$key == 0 ? "offset-lg-1" : ""}}">
                                    <A href="{{$bottom->slug}}" class="design-product text-uppercase font-weight-bold">{{$bottom->name}}</A>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>

            <article class="art-about-us mb-5">
                @php
                    $page = \App\Models\Post::whereType(\App\Enums\PostType::page)->public()->status()->oldest('sort')->latest()->first();
                @endphp

                @if($page)
                    <div class="container">
                        <div class="about-us-box w-75 m-auto">
                            <div class="title-posts">
                                <div class="categories-post-name text-uppercase mb-3">{{$page->title}}</div>
                            </div>
                            <div class="content-box content-about-use">
                                {!! $page->description !!}

                            </div>
                        </div>
                    </div>
        </div>
        @endif
        </article>

      @include('Include.product')
    {{--                <article class="art-testimonials d-none">--}}
    {{--                    <div class="container">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
    {{--                                <div class="testimonials-box">--}}
    {{--                                    <div class="title-box title-testimonials">--}}
    {{--                                        <h3 class="title"><span>Ý kiến khách hàng</span></h3>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="testimonials-content">--}}
    {{--                                        <div class="slick-slider slick-testimonials">--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="testimonial-box">--}}
    {{--                                                    <div class="testimonial-image"> <img src="uploads/images/Anh%20Khach%20Hang/z2168833278023_27e34aa1ca590e8a6a7d7315418b96_1.jpg" alt="AnH Nguyễn Thanh Dũng, công ty TNHH Thiết Kế &amp; In Ấn BlueSail" style="max-width: 180px; max-height: 180px; width: 100%; height: 100%;"> </div>--}}
    {{--                                                    <div class="testimonial-content">--}}
    {{--                                                        <h4 class="testimonial-name"> AnH Nguyễn Thanh Dũng, công ty TNHH Thiết Kế &amp; In Ấn BlueSail </h4>--}}
    {{--                                                        <div class="testimonial-short-des">--}}
    {{--                                                            <p>Trong ng&agrave;nh in ấn n&agrave;y, sơ suất một ch&uacute;t trong kh&acirc;u n&agrave;o từ b&igrave;nh file, in đến th&agrave;nh phẩm cũng l&agrave;&hellip; hư cả đơn h&agrave;ng. Ở c&ocirc;ng ty in ấn In Nhanh Nhanh, b&ecirc;n cạnh sự uy t&iacute;n về thời gian, chất lượng v&agrave; gi&aacute; cả tốt, t&ocirc;i cực kỳ h&agrave;i l&ograve;ng với tinh thần nhiệt t&igrave;nh giải quyết vấn đề, xử l&yacute; sự cố tr&ecirc;n tinh thần nghĩ cho kh&aacute;ch h&agrave;ng, v&igrave; kh&aacute;ch h&agrave;ng. Với t&ocirc;i, sự nhiệt t&igrave;nh v&agrave; hợp t&aacute;c quan trọng hơn mọi yếu tố khi t&ocirc;i cần t&igrave;m kiếm mối quan hệ l&agrave;m ăn l&acirc;u d&agrave;i.</p>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="testimonial-box">--}}
    {{--                                                    <div class="testimonial-image"> <img src="uploads/images/Anh%20Khach%20Hang/Chi%20Duyen.jpg" alt="Chị Duyến Nguyễn, công ty tổ chức sự kiện" style="max-width: 180px; max-height: 180px; width: 100%; height: 100%;"> </div>--}}
    {{--                                                    <div class="testimonial-content">--}}
    {{--                                                        <h4 class="testimonial-name"> Chị Duyến Nguyễn, công ty tổ chức sự kiện </h4>--}}
    {{--                                                        <div class="testimonial-short-des">--}}
    {{--                                                            <p>T&ocirc;i ở tận H&agrave; Nội, nơi c&oacute; rất nhiều xưởng in nhưng vẫn chọn c&ocirc;ng ty&nbsp;in ấn ở In Nhanh Nhanh. Đơn giản v&igrave; t&ocirc;i rất th&iacute;ch sự NHANH, ĐẸP, RẺ, CHU Đ&Aacute;O vốn c&oacute; ở In Nhanh Nhanh. L&agrave;m trong lĩnh vực event, sự kiện, l&uacute;c đầu t&ocirc;i kh&ocirc;ng biết g&igrave; về giấy, về decal&hellip; để chọn chất liệu in ph&ugrave; hợp cho kh&aacute;ch. Nhưng chỉ cần li&ecirc;n hệ với In Nhanh Nhanh, mọi thắc mắc đều được giải quyết v&agrave; t&ocirc;i y&ecirc;n t&acirc;m với mọi sản phẩm khi gửi đến kh&aacute;ch h&agrave;ng.</p>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </article>--}}
    <!-- art-testimonials -->

    {{--                <article class="art-brands d-none">--}}
    {{--                    <div class="container">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
    {{--                                <div class="brands-box">--}}
    {{--                                    <div class="title-box title-brands">--}}
    {{--                                        <h3 class="title"><span>Đối tác của chúng tôi</span></h3>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="brands-content">--}}
    {{--                                        <div class="slick-slider slick-brands">--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="brand-box">--}}
    {{--                                                    <div class="brand-image"> <a href="#" title="Công ty Cổ Phần DKRA Việt Nam"> <img src="uploads/images/Doi%20Tac/DKRA.jpg" alt="Công ty Cổ Phần DKRA Việt Nam" style="max-width: 202px; max-height: 118px; width: 100%; height: 100%;"> </a> </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="brand-box">--}}
    {{--                                                    <div class="brand-image"> <a href="#" title="ELSA Speak"> <img src="uploads/images/Doi%20Tac/ELSA.jpg" alt="ELSA Speak" style="max-width: 202px; max-height: 118px; width: 100%; height: 100%;"> </a> </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="brand-box">--}}
    {{--                                                    <div class="brand-image"> <a href="#" title="Gỗ Đức Thành"> <img src="uploads/images/Doi%20Tac/GO%20DUC%20THANH.jpg" alt="Gỗ Đức Thành" style="max-width: 202px; max-height: 118px; width: 100%; height: 100%;"> </a> </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="brand-box">--}}
    {{--                                                    <div class="brand-image"> <a href="#" title="Công Ty TNHH HASAKI BEAUTY &amp; S.P.A"> <img src="uploads/images/Doi%20Tac/HASAKI%202.jpg" alt="Công Ty TNHH HASAKI BEAUTY &amp; S.P.A" style="max-width: 202px; max-height: 118px; width: 100%; height: 100%;"> </a> </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="item">--}}
    {{--                                                <div class="brand-box">--}}
    {{--                                                    <div class="brand-image"> <a href="#" title="CITIGYM"> <img src="uploads/images/Doi%20Tac/CITYGYM(1).jpg" alt="CITIGYM" style="max-width: 202px; max-height: 118px; width: 100%; height: 100%;"> </a> </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </article>--}}
    <!-- art-brands -->

    {{--                <article class="art-contacts d-none">--}}
    {{--                    <div class="container">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
    {{--                                <div class="contacts-box">--}}
    {{--                                    <div class="title-box title-contacts">--}}
    {{--                                        <h3 class="title"><span>Đăng ký để nhận khuyến mãi</span></h3>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="contacts-content">--}}
    {{--                                        <form class="contacts-form" id="frm_register">--}}
    {{--                                            <div class="form-content">--}}
    {{--                                                <div class="form-group"> <i class="fas fa-user icon"></i>--}}
    {{--                                                    <input class="form-control" type="text" name="name" placeholder="Họ và tên">--}}
    {{--                                                    <span class="fr-error" id="error_name">Lỗi</span> </div>--}}
    {{--                                                <div class="form-group-control">--}}
    {{--                                                    <div class="form-group"> <i class="fas fa-envelope icon"></i>--}}
    {{--                                                        <input class="form-control" type="text" name="email" placeholder="Email">--}}
    {{--                                                        <span class="fr-error" id="error_email">Lỗi</span> </div>--}}
    {{--                                                    <div class="form-group"> <i class="fas fa-phone-alt icon"></i>--}}
    {{--                                                        <input class="form-control" type="text" name="phone" placeholder="Số điện thoại">--}}
    {{--                                                        <span class="fr-error" id="error_phone">Lỗi</span> </div>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="form-group">--}}
    {{--                                                    <div class="button">--}}
    {{--                                                        <button class="btn btn-2 btn-send">Đăng ký ngay</button>--}}
    {{--                                                        <input type="hidden" name="type" value="register">--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </form>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </article>--}}
    <!-- art-contacts -->
    </div>
    </div>
</main>
<script type="text/javascript">
    $('body').addClass('home-body');
</script>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
