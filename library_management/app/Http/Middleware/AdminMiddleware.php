<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này');
        }
        return $next($request);
    }
}
