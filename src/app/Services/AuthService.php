<?php

namespace Arealtime\Auth\App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    private array $data;

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function login()
    {
        $userModel = config('arealtime-auth.user_model');
        $user = $userModel::where('name', $this->data['username'])->first();

        if (empty($user)) {
            return response()->json(['message' => __('auth::messages.not-found')])->setStatusCode(Response::HTTP_NOT_FOUND);
        } else if (!Hash::check($this->data['password'], $user->password)) {

            return response()->json(['message' => __('auth::messages.not-found')])->setStatusCode(Response::HTTP_NOT_FOUND);
        } else {
            $token = $user->createToken(config('arealtime-auth.create_token'))->plainTextToken;

            auth()->login($user);

            return response()->json([
                'message' => __('auth::messages.success.login'),
                'token' => $token
            ])
                ->withCookie(
                    config('arealtime-auth.access_token_name'),
                    config('arealtime-auth.jwt.ttl')
                );
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => __('auth::messages.success.logout')])
            ->withoutCookie(config('arealtime-auth.access_token_name'))
            ->withoutCookie(config('arealtime-auth.refresh_token_name'));
    }
}
