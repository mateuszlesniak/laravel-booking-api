<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_code',
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
