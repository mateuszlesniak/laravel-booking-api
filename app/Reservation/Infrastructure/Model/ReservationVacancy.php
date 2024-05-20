<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model;

use App\Location\Infrastructure\Model\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationVacancy extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'reservation_id',
        'vacancy_id',
        'persons',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
