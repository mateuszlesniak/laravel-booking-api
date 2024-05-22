<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model\Eloquent;

use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use App\Reservation\Application\DTO\ReservationStatus;
use App\User\Infrastructure\Model\Eloquent\UserEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationEntity extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'location_id',
        'date_in',
        'date_out',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date_in' => 'immutable_date',
        'date_out' => 'immutable_date',
        'status' => ReservationStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(LocationEntity::class);
    }

    public function reservationVacancies(): HasMany
    {
        return $this->hasMany(ReservationVacancyEntity::class, 'reservation_id', 'id');
    }

    protected function casts(): array
    {
        return [
            'status' => ReservationStatus::class,
        ];
    }
}
