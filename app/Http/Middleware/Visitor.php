<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function getDomain($url)
    {
        preg_match("/[a-z0-9\-]{1,63}\.[a-z\.]{2,6}$/", parse_url($url, PHP_URL_HOST), $domain);
        return $domain[0];
    }

    public function handle(Request $request, Closure $next)
    {
        if(empty($request->headers->get('referer')))
            return $next($request);

        $ip = $request->ip();
        $ref =  $this->getDomain($request->headers->get('referer'));
        $host = $request->getHost();

        if($ref == $host)
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
