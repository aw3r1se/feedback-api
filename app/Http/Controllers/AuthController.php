<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    public function me(Request $request): UserResource
    {
        $appends = $request->get('with', []);

        /** @var User $user */
        $user = Auth::user()
            ->load($appends);

        return UserResource::make($user)
            ->addAppends($request->get('with', $appends));
    }

    public function login(Request $request): JsonResponse
    {
        $user = Auth::user();
        if ($user) {
            return response()
                ->json([
                    'message' => 'already authenticated',
                ], 400);
        }

        try {
            $data = $request->validate([
                'email' => ['required', 'email:rfc', 'exists:users'],
                'password' => ['required', 'min:8', 'max:64'],
            ]);
        } catch (Throwable) {
            return $this->respondUnauthenticated();
        }

        $token = Auth::attempt($data);
        if ($token) {
            return $this->respondWithToken($token);
        }

        return response()
            ->json([
                'message' => 'Unauthenticated',
            ], 401);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout(): Response
    {
        Auth::logout();

        return response()
            ->noContent();
    }

    protected function respondWithToken(string $token): JsonResponse
    {
        return response()
            ->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60,
            ]);
    }

    protected function respondUnauthenticated(): JsonResponse
    {
        return response()
            ->json([
                'message' => 'Unauthenticated',
            ], 401);
    }
}
