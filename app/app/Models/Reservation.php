<?php

namespace App\Models;

use App\Casts\CheckInDateCast;
use App\Enums\ReservationStatusEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $check_in_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $status
 * @property-read User $user
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereCheckInDate($value)
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereStatus($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @method static Builder|Reservation whereUserId($value)
 * @property-read mixed $status_text
 * @mixin Eloquent
 */
class Reservation extends Model
{

    protected $fillable = [
        'check_in_date',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        "check_in_date" => CheckInDateCast::class,
    ];

    protected $appends = ["status_text"];

    public function getStatusTextAttribute()
    {
        return ReservationStatusEnum::getName(ReservationStatusEnum::from($this->status));
    }
}
