<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Resource;

use App\Location\UI\Controller\Resources\LocationResource;
use App\Reservation\Application\DTO\ReservationData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var ReservationData $this */
        return [
            'id' => $this->getId(),
            'location' => LocationResource::make(
                $this->getLocationDTO(),
            ),
            'date_in' => $this->getStartDate()->format('Y-m-d'),
            'date_out' => $this->getEndDate()->format('Y-m-d'),
            'status' => $this->getStatus()->name,
        ];
    }
}
