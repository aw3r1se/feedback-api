<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /** @var User $user */
        $user = Auth::user();
        if ($user->can($ability)) {
            return $next($request);
        }

        return response()
            ->json([
               'message' => 'access denied',
            ]);
    }
}
