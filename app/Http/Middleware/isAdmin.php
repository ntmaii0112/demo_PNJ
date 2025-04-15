<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        //Nếu chưa login hoặc không có role admin
        if(!$user || !$user->hasRole('admin')){
            abort(403,'Bạn không có quyền truy cập trang này');
        }
        return $next($request);
    }
}
