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

        $ip = $request->ip();
        $ref = parse_url($request->headers->get('referer'), PHP_URL_HOST);
        $host = $request->getHost();

        if(substr($ref, 0 - strlen($host)) == $host)
            return $next($request);

        $vistor = \App\Models\Visitor::whereRefererDomain($ref)->whereRefererIp($ip)->first();

        if($vistor){
            if($vistor->updated_at->addMinutes(15) <= now()){
                $vistor->increment('referer_count');
                $vistor->save();
            }
        }else{
            $vistor = new \App\Models\Visitor();
            $vistor->referer_domain = $ref;
            $vistor->referer_ip = $ip;
            $vistor->save();
        }

        return $next($request);
    }
}
