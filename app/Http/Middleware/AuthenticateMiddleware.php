<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    public function handle($request, Closure $next)
    {
        // if (!Auth::check()) {
        //     return redirect('/login'); // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้า login
        // }

        // return $next($request);
    }
}
