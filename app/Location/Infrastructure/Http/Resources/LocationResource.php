<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Http\Resources;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var $this Location */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'country' => $this->country,
        ];
    }
}
