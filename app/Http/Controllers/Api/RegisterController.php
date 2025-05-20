<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }

        $user = auth('api')->user();
        $success['token'] = $token;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User login successfully.');
    }

}
