<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPageCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission): Response
    {
        $loginUserRole = session()->get('emp_login')['role'];
        $permission = explode('|', $permission);
        if (in_array($loginUserRole, $permission)) {
            return $next($request);
        } else {
            print_r('You dont have access to this page');
            exit;
        }
    }
}
