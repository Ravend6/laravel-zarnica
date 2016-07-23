<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Admin
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
        if ($request->is('admin') or $request->is('admin/*')) {
            if (\Auth::guest()) {
                return redirect('/')->with('flash_info', 'У вас нет прав доступа.');
            }

            if (!is_admin_role(\Auth::user())) {
                return redirect('/')->with('flash_info', 'У вас нет прав доступа.');
            }
        }
        return $next($request);
    }
}
