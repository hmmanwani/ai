<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $mobileAgents = [
            'iPhone', 'iPod', 'Android', 'BlackBerry', 'Opera Mini', 'IEMobile', 'Mobile', 'Windows Phone', 'webOS', 'Symbian', 'Fennec', 'HTC'
        ];

        // Check if the user is already on the no-mobile page
        if ($request->is('no-mobile')) {
            return $next($request);
        }

        // Check if the request is from a mobile device
        $isMobile = false;
        foreach ($mobileAgents as $agent) {
            if (stripos($request->header('User-Agent'), $agent) !== false) {
                $isMobile = true;
                break;
            }
        }

        // Check if the request is from Chrome Desktop Mode on mobile
        $isChromeDesktopMode = stripos($request->header('User-Agent'), 'Chrome') !== false
            && stripos($request->header('User-Agent'), 'Mobile Safari') !== false;

        // Redirect to the no-mobile page if it's a mobile device or Chrome Desktop Mode on mobile
        if ($isMobile || $isChromeDesktopMode) {
            return redirect('/no-mobile');
        }

        return $next($request);
    }
}
