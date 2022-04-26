<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepositoryInterface;

    public function __construct(AuthRepositoryInterface $authRepositoryInterface)
    {
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function login(Request $request): mixed
    {
        return $this->authRepositoryInterface->login($request);
    }

    public function logout(): mixed
    {
        return $this->authRepositoryInterface->logout();
    }

    public function userProfile(): mixed
    {
        return $this->authRepositoryInterface->userProfile();
    }

}
