<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language =  session()->get('lang',  config('app.locale'));
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
        App::setLocale($language);
        Carbon::setLocale($language);
        //config(['app.locale' => $language]);
        // Chuyển ứng dụng sang ngôn ngữ được chọn

        return $next($request);
    }
}
