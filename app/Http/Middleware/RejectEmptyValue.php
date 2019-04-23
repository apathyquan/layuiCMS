<?php

namespace App\Http\Middleware;

use Closure;

class RejectEmptyValue
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
                // 过滤空值
        $params = collect($request)->map(function ($item) {

            if ($item == '') {
                $item = "";
            }
            return $item;
        });
        $request->replace($params->all());
        return $next($request);
    }
}
