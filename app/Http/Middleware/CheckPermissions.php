<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param string $ability
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $ability): Response
    {
        //todo check

        return $next($request);
    }
}
