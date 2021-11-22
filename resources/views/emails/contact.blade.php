@component('mail::message')
    # Liên hệ từ khách hàng

@if(request()->has('data.name'))
    Tên khách hàng: {{request()->input('data.name')}}
@endif

@if(request()->has('data.email'))
    Email: {{request()->input('data.email')}}
@endif

@if(request()->has('data.phone'))
    Số điện thoại: {{request()->input('data.phone')}}
@endif

@if(request()->has('data.note'))
    Lời nhắn: {{request()->input('data.note')}}
@endif

{{--    @component('mail::button', ['url' => config('app.url') ])--}}
{{--        Vào panel--}}
{{--    @endcomponent--}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
