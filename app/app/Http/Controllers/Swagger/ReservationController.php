<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post (
 *     path="/api/reservation",
 *     summary="Создание Брони",
 *     tags={"Reservation"},
 *     security={{ "bearerAuth" : {} }},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *             @OA\Schema (
 *                 required={"check_in_date"},
 *                 @OA\Property(property="user_id", type="int", example=1),
 *                 @OA\Property(property="check_in_date", type="date", example="23.11.2024"),
 *                 @OA\Property(property="status", enum="App\Enums\ReservationStatusEnum", type="int", example=1),
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
 *                 @OA\Property(property="reservation", type="object",
 *                     @OA\Property(property="user_id", type="int", example=1),
 *                     @OA\Property(property="check_in_date", type="date", example="2024-12-27"),
 *                     @OA\Property(property="status", type="int", example=1),
 *                     @OA\Property(property="updated_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="created_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="id", type="int", example=20),
 *                     @OA\Property(property="status_text", type="bool", example="Подтвержден"),
 *                 ),
 *             ),
 *          )
 *     ),
 *     @OA\Response (
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Токен авторизации истек"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=400,
 *         description="Неверный запрос",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Вы не можете указать id другого пользователя"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=422,
 *         description="Невалидные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="не передано поле N"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="limit", type="array", @OA\Items(
 *                     type="string",
 *                     example="не передано поле N"
 *                 )),
 *             ),
 *         )
 *     ),
 * ),
 *
 * @OA\Get (
 *     path="/api/reservation",
 *     summary="Получение броней пользователя. Или если авторизованны за админа, то броней всех пользователей",
 *     tags={"Reservation"},
 *     security={{ "bearerAuth" : {} }},
 *     @OA\Parameter (
 *         description="Сколько броней на странице получить",
 *         in="query",
 *         name="limit",
 *         @OA\Schema(type="int"),
 *         example=5
 *     ),
 *     @OA\Parameter (
 *         description="Сколько броней пропустить",
 *         in="query",
 *         name="offset",
 *         @OA\Schema(type="int"),
 *         example=0
 *     ),
 *     @OA\Parameter (
 *         description="Фильтрация по статусу",
 *         in="query",
 *         name="status",
 *         @OA\Schema(type="int", enum="App\Enums\ReservationStatusEnum",example=1),
 *     ),

 *     @OA\Response (
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Токен авторизации истек"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=422,
 *         description="Невалидные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="не передано поле N"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="limit", type="array", @OA\Items(
 *                     type="string",
 *                     example="не передано поле N"
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=400,
 *         description="Неверный запрос",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Вы не можете указать id другого пользователя"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=200,
 *         description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=true),
 *                 @OA\Property(property="reservations", type="array", @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="user_id", type="int", example=1),
 *                     @OA\Property(property="check_in_date", type="date", example="2024-12-27"),
 *                     @OA\Property(property="status", type="int", example=1),
 *                     @OA\Property(property="updated_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="created_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="id", type="int", example=20),
 *                     @OA\Property(property="status_text", type="bool", example="Подтвержден"),
 *                 ),
 *                 )),
 *             ),
 *          )
 *     ),
 * ),
 * @OA\Put (
 *     path="/api/reservation/{reservation}",
 *     summary="Получение брони по id. Только админ может получить любую бронь. Обычный пользователь, только свою",
 *     tags={"Reservation"},
 *     security={{ "bearerAuth" : {} }},
 *     @OA\Parameter (
 *         description="id брони",
 *         in="path",
 *         name="reservation",
 *         @OA\Schema(type="int"),
 *         example=2
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *
 *             @OA\Schema (
 *                 @OA\Property(property="check_in_date", type="date", example="23.11.2024"),
 *                 @OA\Property(property="status", enum="App\Enums\ReservationStatusEnum", type="int", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response (
 *         response=200,
 *         description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=true),
 *                 @OA\Property(property="reservation", type="object",
 *                     @OA\Property(property="user_id", type="int", example=1),
 *                     @OA\Property(property="check_in_date", type="date", example="2024-12-27"),
 *                     @OA\Property(property="status", type="int", example=1),
 *                     @OA\Property(property="updated_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="created_at", type="timestamp", example="2024-11-23T12:48:03.000000Z"),
 *                     @OA\Property(property="id", type="int", example=20),
 *                     @OA\Property(property="status_text", type="bool", example="Подтвержден"),
 *                 ),
 *             ),
 *          )
 *     ),
 *     @OA\Response (
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Токен авторизации истек"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=400,
 *         description="Неверный запрос",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Вы не можете указать id другого пользователя"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=422,
 *         description="Невалидные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="не передано поле N"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="limit", type="array", @OA\Items(
 *                     type="string",
 *                     example="не передано поле N"
 *                 )),
 *             ),
 *         )
 *     ),
 * ),
 * @OA\Delete (
 *     path="/api/reservation/{reservation}",
 *     summary="Удаление брони по id. Только админ может удалить любую бронь. Обычный пользователь, только свою",
 *     tags={"Reservation"},
 *     security={{ "bearerAuth" : {} }},
 *     @OA\Parameter (
 *         description="id брони",
 *         in="path",
 *         name="reservation",
 *         @OA\Schema(type="int"),
 *         example=2
 *     ),
 *     @OA\Response (
 *         response=200,
 *         description="ok",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=true),
 *                 @OA\Property(property="message", type="string", example="Бронь #1 успешно удалена"),
 *             ),
 *          )
 *     ),
 *     @OA\Response (
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Токен авторизации истек"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=400,
 *         description="Неверный запрос",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="errors", type="array", @OA\Items(
 *                     @OA\Property(property="error", type="string", example="Вы не можете удалить данную бронь"),
 *                 )),
 *             ),
 *         )
 *     ),
 *     @OA\Response (
 *         response=422,
 *         description="Невалидные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="success", type="bool", example=false),
 *                 @OA\Property(property="error", type="string", example="Данной брони не существует"),
 *             ),
 *         )
 *     ),
 * )
 */
class ReservationController extends Controller
{
}
