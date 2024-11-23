<?php

namespace App\Http\Controllers;

use App\Dto\IndexReservationDto;
use App\Dto\ReservationShowDto;
use App\Dto\ReservationUpdateDto;
use App\Dto\StoreReservationDto;
use App\Http\Middleware\CheckReservationExist;
use App\Http\Requests\IndexReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    {
        $this->middleware(CheckReservationExist::class, ['only' => ['update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexReservationRequest $request): JsonResponse
    {
        $dto = IndexReservationDto::init(...$request->validated());

        $result = $this->reservationService->index($dto);

        $statusCode = $result->getSuccess() ? 200 : 400;

        return JsonResource::make($result->getArray())->response()->setStatusCode($statusCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $dto = StoreReservationDto::init(...$request->validated());

        $result = $this->reservationService->store($dto);

        $statusCode = $result->getSuccess() ? 200 : 400;

        return JsonResource::make($result->getArray())->response()->setStatusCode($statusCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation): JsonResponse
    {
        $dto = ReservationShowDto::init($reservation);

        $result = $this->reservationService->show($dto);

        $statusCode = $result->getSuccess() ? 200 : 400;

        return JsonResource::make($result->getArray())->response()->setStatusCode($statusCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request): JsonResponse
    {
        $dto = ReservationUpdateDto::init($request["reservation"], ...$request->validated());

        $result = $this->reservationService->update($dto);

        $statusCode = $result->getSuccess() ? 200 : 400;

        return JsonResource::make($result->getArray())->response()->setStatusCode($statusCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->reservationService->destroy($request["reservation"]);

        $statusCode = $result->getSuccess() ? 200 : 400;

        return JsonResource::make($result->getArray())->response()->setStatusCode($statusCode);
    }
}
