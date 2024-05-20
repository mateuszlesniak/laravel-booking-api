<?php

namespace App\Reservation\UI\Controller\Resource;

use App\Reservation\Application\DTO\ReservationDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ReservationDTO|$this $this */
        return [
            'id' => $this->getId(),
        ];
    }
}
