<div class="item-card">
    <div class="item-card-thumb">
        <img src="{{$product->thumb}}" alt="{{$product->name}}">
        <div class="item-level">Featured</div>
    </div>
    <div class="item-card-content">
        <div class="item-card-content-top">
            <div class="left">
{{--                <div class="author-thumb">--}}
{{--                    <img src="assets/images/user.jpg" alt="fordsesa">--}}
{{--                </div>--}}
{{--                <div class="author-content">--}}
{{--                    <h5 class="name"><a href="user/fordsesa.html">fordsesa</a> <span class="level-text"> level-5</span></h5>--}}
{{--                    <div class="ratings">--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                        <span class="rating me-2">2</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="right">
                <div class="item-amount">${{$product->price}}</div>
            </div>
        </div>
        <h3 class="item-card-title"><a href="{{$product->slug}}">{{$product->name}}</a></h3>
    </div>
    <div class="item-card-footer">
        <div class="left">
{{--            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="27"><i class="fas fa-heart"></i> <span class="give-love-amount">(3)</span></a>--}}
{{--            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> (2)</a>--}}
        </div>
        <div class="right">
            <div class="order-btn">
                <a href="{{$product->slug}}#order" class="btn--base"><i class="las la-shopping-cart"></i> Order Now</a>
            </div>
        </div>
    </div>
</div>