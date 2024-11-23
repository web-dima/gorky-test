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
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reservationId = $request["reservation"];
        $reservation = Reservation::find($reservationId);

        if (is_null($reservation)) {
            return JsonResource::make(ReservationErrorDto::init("Данной брони не существует")->getArray())->response()->setStatusCode(422);
        } else {
            $request["reservation"] = $reservation;
            return $next($request);
        }
    }
}
