<?php

namespace App\Http\Middleware;

use App\Dto\ReservationErrorDto;
use App\Models\Reservation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CheckReservationExist
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResource|Response
     */
    public function handle(Request $request, Closure $next): JsonResource|Response
    {
        $reservationID = $request["reservation"];
        $reservation = Reservation::find($reservationID);

        if (is_null($reservation)) {
            return JsonResource::make(ReservationErrorDto::init("Данной брони не существует")->getArray());
        } else {
            $request["reservation"] = $reservation;
            return $next($request);
        }
    }
}
