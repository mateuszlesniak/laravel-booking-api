<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Model;

use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'country',
        'location_code',
        'is_active'
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    protected static function newFactory()
    {
        return LocationFactory::new();
    }
}
