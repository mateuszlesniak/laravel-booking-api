<?php

declare(strict_types=1);

namespace App\Location\UI\Controller\Resources;

use App\Location\Application\DTO\LocationData;
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
        /* @var $this LocationData */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'country_code' => $this->getCountryCode(),
        ];
    }
}
