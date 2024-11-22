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
use Illuminate\Http\Request;
use App\Services\ReservationService;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    {
        $this->middleware(CheckReservationExist::class, ['only' => ['update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexReservationRequest $request): JsonResource
    {
        $dto = IndexReservationDto::init(...$request->validated());

        $result = $this->reservationService->index($dto);

        return JsonResource::make($result->getArray());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request): JsonResource
    {
        $dto = StoreReservationDto::init(...$request->validated());

        $result = $this->reservationService->store($dto);

        return JsonResource::make($result->getArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation): JsonResource
    {
        $dto = ReservationShowDto::init($reservation);

        $result = $this->reservationService->show($dto);

        return JsonResource::make($result->getArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request): JsonResource
    {

        $dto = ReservationUpdateDto::init($request["reservation"], ...$request->validated());

        $result = $this->reservationService->update($dto);

        return JsonResource::make($result->getArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResource
    {
        $result = $this->reservationService->destroy($request["reservation"]);

        return JsonResource::make($result->getArray());
    }
}
