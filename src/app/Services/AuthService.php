<?php

namespace Arealtime\Auth\App\Services;

use Arealtime\Auth\App\Console\Commands\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    private array $data;

    public function setData(array $data)
    {
        return $this->data = $data;
    }

    public function login()
    {
        $userModel = config('arealtime-auth.user_model');
        $user = $userModel::where('username', $this->data['username']);

        if (empty($user)) {
            return response()->json(['message' => 'Unauthorized'])->setStatusCode(Response::HTTP_NOT_FOUND);
        } else if (!Hash::check($this->data['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'])->setStatusCode(Response::HTTP_NOT_FOUND);
        } else {

            Auth::login($user);

            return response()->json([
                'message' => 'Login',
            ])
                ->withCookie(config('arealtime-auth.access_token_name'), config('arealtime-auth.jwt.ttl'))
                ->withCookie(config('arealtime-auth.refresh_token_name'), Auth::user()->createRefreshToken(), config('arealtime-auth.jwt.refresh_ttl'));
        }
    }

    public function logout()
    {
        Auth::user()->revokeTokensByJwtToken();

        Auth::logout();

        return response()->json([
            'message' => 'Logout'
        ])
            ->withoutCookie(config('arealtime-auth.access_token_name'))
            ->withoutCookie(config('arealtime-auth.refresh_token_name'));
    }
}
