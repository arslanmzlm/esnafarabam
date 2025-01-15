<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('admin.*')) {
            $user = $request->user();

            if (!$user->isAdmin()) return to_route('homepage');

            if (!$user->checkAbility($request->route()->getName())) abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
