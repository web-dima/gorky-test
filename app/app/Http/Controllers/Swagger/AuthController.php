<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post (
 *     path="/api/login",
 *     summary="Авторизация",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *             @OA\Schema (
 *                 required={"email","password"},
 *                 @OA\Property(property="email", type="string", example="dmitry@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="123"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response (
 *         response=200,
 *         description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=true),
 *                 @OA\Property(property="access_token", type="string", example="adsa32aalfamas.dsadas.tdsf"),
 *                 @OA\Property(property="token_type", type="string", example="bearer"),
 *                 @OA\Property(property="expires_in", type="int", example=3600),
 *             ),
 *          )
 *     ),
 *     @OA\Response (
 *         response=401,
 *         description="невернный пароль",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Неверные данные для авторизации"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=422,
 *         description="Невалидные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Данной почты нет в базе"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="email", type="array", @OA\Items(
 *                     type="string",
 *                     example="Данной почты нет в базе"
 *                 )),
 *             ),
 *         )
 *     ),
 * ),
 */
class AuthController extends Controller
{
}
