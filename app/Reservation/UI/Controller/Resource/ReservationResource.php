<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Resource;

use App\Location\UI\Controller\Resources\LocationResource;
use App\Reservation\Domain\Model\Reservation;
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
        /* @var Reservation $this */
        return [
            'id' => $this->id,
            'location_code' => $this->locationCode,
            'date_in' => $this->dateIn,
            'date_out' => $this->dateOut,
            'status' => $this->status,
        ];
    }
}
