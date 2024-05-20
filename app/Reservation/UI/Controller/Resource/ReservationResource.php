<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Resource;

use App\Reservation\Application\DTO\ReservationDTO;
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
        /* @var ReservationDTO|$this $this */
        return [
            'id' => $this->getId(),
            'location' => [
                'id' => $this->getLocationDTO()->getId(),
                'code' => $this->getLocationDTO()->getLocationCode(),
                'name' => $this->getLocationDTO()->getName(),
            ],
            'date_in' => $this->getStartDate()->format('Y-m-d'),
            'date_out' => $this->getEndDate()->format('Y-m-d'),
            'status' => $this->getStatus()->name,
        ];
    }
}
