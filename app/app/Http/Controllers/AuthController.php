<?php

namespace App\Http\Controllers;

use App\Dto\AuthErrorDto;
use App\Dto\AuthTokenDto;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResource|JsonResponse
    {
        $credentials = $request->validated();

        if (! $token = auth()->attempt($credentials)) {
            return JsonResource::make(AuthErrorDto::init("Неверные данные для авторизации")->getArray())->response()->setStatusCode(401);
        }

        return JsonResource::make(AuthTokenDto::init(...[
            'accessToken' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * 60,
        ])->getArray());
    }
}
