<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Model\Eloquent;

use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationEntity extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'address',
        'country',
        'location_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(LocationVacancyEntity::class, 'location_id', 'id');
    }

    protected static function newFactory(): Factory
    {
        return LocationFactory::new();
    }
}
