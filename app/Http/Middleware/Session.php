<?php

namespace App\Http\Middleware;

use App\Enums\ActiveDisable;
use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class Session
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!session()->has('lang')){
            $language = Language::whereStatus(ActiveDisable::active)->first();
            $value = $language ? $language->value : config('app.locale');
            session()->put('lang',$value);
        }

        if(setting('site.languages')){
            $languages = Language::oldest('status')->get();
        }else{
            $languages = Language::oldest('status')->take(1)->get();
        }
        session()->put('language', $languages);

        return $next($request);
    }
}
