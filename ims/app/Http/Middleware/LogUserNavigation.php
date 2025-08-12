<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogUserNavigation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('current_url')) {
            $request->session()->put('previous_url', $request->session()->get('current_url'));
        }
        $request->session()->put('current_url', [
            'url' => $request->fullUrl(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return $next($request);
    }
}
