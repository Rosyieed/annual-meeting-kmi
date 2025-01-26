<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredProcess = null): Response
    {
        $user = Auth::user();

        // Jika user belum login, arahkan ke login
        if (!$user) {
            return redirect()->route('home');
        }

        // Jika user belum menyelesaikan proses, arahkan ke halaman yang sesuai
        if ($user->intProcessStep == 0 && $request->routeIs('question') === false) {
            return redirect()->route('question');
        }

        if ($user->intProcessStep == 1 && $request->routeIs('congratulations') === false) {
            return redirect()->route('congratulations');
        }

        if ($user->intProcessStep == 2 && ($request->routeIs('congratulations') === false || $request->routeIs('question') === false)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
