<style>
    .red {
        color: red;
    }
</style>

{{request()->attr}}
@foreach(\App\Models\Attribute::whereCategoryId(0)->oldest('sort')->get() as $attribute)
    <p style="font-weight: bold">{{$attribute->title}}</p>
    @foreach(\App\Models\Attribute::whereCategoryId($attribute->id)->oldest('sort')->get() as $sub)

        @if(disable($sub->title, explode(',', request()->attr)))
            <a href="{{$sub->remove_slug}}" style="padding-left: 30px" class="red">x {{$sub->title}}</a>
        @else
            <a href="{{$sub->slug}}" style="padding-left: 30px" class=""  >{{$sub->title}}</a>
        @endif

        <hr>
    @endforeach
    <hr>
@endforeach


@foreach($products as $product)
    <div class="">
        <img src="{{$product->thumbnail}}">
        <hr>
        {{$product->translation->name}}
    </div>
    <hr>
@endforeach
