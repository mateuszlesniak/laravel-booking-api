<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model\Eloquent;

use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationVacancyEntity extends Model
{
    public $timestamps = false;
    protected $table = 'reservation_vacancies';

    protected $fillable = [
        'reservation_id',
        'vacancy_id',
        'persons',
    ];

    protected $casts = [
        'persons' => 'integer',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(LocationVacancyEntity::class);
    }
}
