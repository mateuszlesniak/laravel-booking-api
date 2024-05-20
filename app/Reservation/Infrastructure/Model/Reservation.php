<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Model;

use App\Location\Infrastructure\Model\Location;
use App\User\Infrastructure\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'date_in',
        'date_out',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
