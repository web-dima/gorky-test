<?php

namespace App\Http\Middleware;

use App\Dto\AuthErrorDto;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthMiddleware
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse|RedirectResponse
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return JsonResource::make(AuthErrorDto::init("Токен авторизации невалидный")->getArray())
                ->response()->setStatusCode(401);
        } catch (TokenExpiredException $e) {
            return JsonResource::make(AuthErrorDto::init("Токен авторизации истек")->getArray())
                ->response()->setStatusCode(401);
        } catch (Exception $e) {
            return JsonResource::make(AuthErrorDto::init("Не авторизован")->getArray())
                ->response()->setStatusCode(401);
        }

        $request["user"] = $user;
        return $next($request);
    }
}
