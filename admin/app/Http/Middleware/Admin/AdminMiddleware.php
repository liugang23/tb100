<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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
        // 获取上一次访问的地址 
        $return_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        // Session::has('admin')  检测用户是否存在
        if (empty(Session::get('admin'))) {
            // return redirect('/login');
            // urlencode 将字符串以 URL 编码,之所以要进行编码，是因为Url中有些字符会引起歧义。为避免意外发生，这里进行编码
            return redirect('/login?return_url='.urlencode($return_url));
        }
        return $next($request);
    }
}
