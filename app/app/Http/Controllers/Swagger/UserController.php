<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get (
 *     path="/api/users",
 *     summary="Список пользователей для авторизации. Пароль у всех 123(для удобства тестирования разместил здесь эту информацию)",
 *     tags={"User"},
 *     @OA\Response (
 *         response=200,
 *         description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 type="array", @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="int", example=1),
 *                     @OA\Property(property="name", type="string", example="Петр"),
 *                     @OA\Property(property="email", type="int", example="Peter@gmail.com"),
 *                     @OA\Property(property="is_admin", type="timestamp", example=0),
 *                 ),
 *                 )),
 *             ),
 *          )
 *     ),
 * ),
*/
class UserController extends Controller
{
}
