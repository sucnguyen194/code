<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Vistor
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

        if(empty($request->headers->get('referer')))
            return $next($request);

        $ref = $request->headers->get('referer');

        if(strpos($ref, $request->getHost()) == true)
            return $next($request);

        $ip = $request->ip();
        $vistor = \App\Models\Vistor::whereRefererDomain($ref)->whereRefererIp($ip)->first();

        if($vistor){
            if($vistor->updated_at->addMinutes(15) <= now()){
                $vistor->increment('referer_count');
                $vistor->save();
            }
        }else{
            $vistor = new  \App\Models\Vistor();
            $vistor->referer_domain = $ref;
            $vistor->referer_ip = $ip;
            $vistor->save();
        }

        return $next($request);
    }
}
