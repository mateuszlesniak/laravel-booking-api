<?php

declare(strict_types=1);

namespace App\Location\UI\Controller\Resources;

use App\Location\Domain\Model\Location;
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
            'location_code' => $this->locationCode,
            'address' => $this->address,
            'country_code' => $this->country,
        ];
    }
}
