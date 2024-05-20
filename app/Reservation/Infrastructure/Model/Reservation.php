<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model;

use App\Location\Infrastructure\Model\Location;
use App\Reservation\Application\DTO\ReservationStatus;
use App\User\Infrastructure\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'date_in',
        'date_out',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ReservationStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function reservationVacancies(): HasMany
    {
        return $this->hasMany(ReservationVacancy::class);
    }
}
