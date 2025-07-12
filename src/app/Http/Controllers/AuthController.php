<?php

namespace Arealtime\Auth\App\Http\Controllers;

use Arealtime\Auth\App\Http\Requests\LoginRequest;
use Arealtime\Auth\App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{

    public function __construct(private readonly AuthService $authService) {}

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->setData([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ])->login();
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
