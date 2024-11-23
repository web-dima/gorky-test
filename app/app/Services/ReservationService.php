<?php

namespace App\Services;

use App\Dto\IndexReservationDto;
use App\Dto\ReservationArrayDto;
use App\Dto\ReservationDestroyDto;
use App\Dto\ReservationErrorDto;
use App\Dto\ReservationShowDto;
use App\Dto\ReservationStoreErrorDto;
use App\Dto\ReservationStoreSuccessDto;
use App\Dto\ReservationUpdateDto;
use App\Dto\StoreReservationDto;
use App\Models\Reservation;
use App\Models\User;

class ReservationService
{
    public function store(StoreReservationDto $reservationDto): ReservationStoreSuccessDto|ReservationErrorDto
    {
        /** @var User $user */
        $user = auth()->user();
        $reservationUserID = $reservationDto->getUserId();

        if ($user->is_admin) { // Если пользователь админ, то он должен указать user_id
            if ($reservationUserID) {
                $newReservation = Reservation::create($reservationDto->getArray());
                return ReservationStoreSuccessDto::init($newReservation);
            } else {
                return ReservationErrorDto::init("Администратору необходимо указать какому пользователю создать Бронь");
            }
        } else { // Если пользователь не админ, то он должен указать либо свой user_id либо без него
            if ($reservationUserID && $reservationUserID != $user->id) {
                return ReservationErrorDto::init("Вы не можете указать id другого пользователя");
            }

            $reservationDto->setUserId($user->id);
            $newReservation = Reservation::create($reservationDto->getArray());

            return ReservationStoreSuccessDto::init($newReservation);
        }
    }

    public function show(ReservationShowDto $reservationDto): ReservationErrorDto|ReservationShowDto
    {
        /** @var User $user */
        $user = auth()->user();
        $reservationModel = $reservationDto->getReservation();

        if ($user->is_admin) {
            return $reservationDto;
        } else {
            if ($reservationModel->user_id == $user->id) {
                return $reservationDto;
            } else {
                return ReservationErrorDto::init("У вас нет доступа к данной брони");
            }
        }
    }

    public function update(ReservationUpdateDto $reservationDto): ReservationErrorDto|ReservationShowDto
    {
        /** @var User $user */
        $user = auth()->user();
        $reservationID = $reservationDto->getReservationID();
        $reservationUserID = $reservationDto->getOwnerUserID();

        if ($user->is_admin) {
            $reservation = Reservation::find($reservationID);
            $reservation->update($reservationDto->getArray());

            return ReservationShowDto::init(Reservation::find($reservationID));
        } else {
            if ($reservationUserID == $user->id) {
                return ReservationShowDto::init(Reservation::find($reservationID));
            } else {
                return ReservationErrorDto::init("У вас нет доступа к данной брони");
            }
        }
    }

    public function destroy(Reservation $reservation): ReservationDestroyDto|ReservationErrorDto
    {
        /** @var User $user */
        $user = auth()->user();
        $reservationUserID = $reservation->user_id;
        $reservationID = $reservation->id;

        if ($user->is_admin) {
            $reservation->delete();
            return ReservationDestroyDto::init("Бронь #$reservationID успешно удалена");
        } else {
            if ($reservationUserID == $user->id) {
                $reservation->delete();
                return ReservationDestroyDto::init("Бронь #$reservationID успешно удалена");
            } else {
                return ReservationErrorDto::init("Вы не можете удалить данную бронь");
            }
        }
    }

    public function index(IndexReservationDto $dto): ReservationArrayDto
    {
        /** @var User $user */
        $user = auth()->user();

        $queryBuilder = Reservation::query();
        $status = $dto->getStatus();
        $limit = $dto->getLimit();
        $offset = $dto->getOffset();

        if (!is_null($status)) {
            $queryBuilder->orderByRaw("IF(status = ?, 0, 1)", [$status]);
        }
        if (!is_null($limit)) {
            $queryBuilder->limit($limit);
        }
        if (!is_null($offset)) {
            $queryBuilder->offset($offset);
        }

        if (!$user->is_admin) {
            $queryBuilder->where("user_id", "=", $user->id);
        }
        $reservationsList = $queryBuilder->get()->toArray();

        return ReservationArrayDto::init($reservationsList);
    }
}
