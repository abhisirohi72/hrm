<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!file_exists(storage_path('db.lock')) && $request->path() !== 'install/database') {
            if (Route::has('installer.database_form')) {
                // echo "enter"; exit;
                return redirect()->route('installer.database_form');
            } else {
                abort(403, 'Installation route is missing.');
            }
        }
        return $next($request);
    }
}
