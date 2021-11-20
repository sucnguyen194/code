<article class="text-center u-block-hover g-transition-0_4">
    <figure style="overflow: hidden; border: 1px solid #468b2d">
        <img class="img-fluid u-block-hover__main--zoom-v1 img-product" src="{{$item->thumb}}" alt="{{$item->name}}">
    </figure>
    <h3 class="h6 g-pa-10 g-mb-0" style="color: #f00; font-weight: bold">
        <span class="g-color-gray-dark-v2">Giá: </span>@if($item->price_sale > 0 )
            <span style="font-size: 16px">{{number_format($item->price_sale)}}</span>  <strike class="g-color-gray-dark-v2">({{number_format($item->price)}})</strike>
        @else
            {{$item->price > 0 ? number_format($item->price) : "liên hệ"}}
        @endif
    </h3>
    <h3 class="h6 g-color-primary--hover g-pa-10 g-mb-0">
        {{$item->name}}
    </h3>
    <a class='u-link-v2 g-color-gray-dark-v2' href="{{$item->slug}}" ></a>
</article>
