<?php

namespace App\Http\Middleware\Home;

use Closure;

class ResponseMiddleware
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
        $data = $next($request);
        $code = $data->getStatusCode();
        // $info = $data->getResultInfo();
        if ($code != 200) {
            return response()->json(
                [
                    'serverTime' => time(),
                    'statusCode' => $code,
                    'resultInfo' => '请求失败',
                    'resultData' => '' 
                ]
            );
        } else {
            return response()->json(
                [
                    'serverTime' => time(),
                    'statusCode' => $code,
                    'resultInfo' => '请求成功',
                    'resultData' => $data->content()
                ]
            );
        }
    }
}
