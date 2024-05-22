<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date_in' => ['required', 'date', 'date_format:Y-m-d', 'after:today'],
            'date_out' => ['required', 'date', 'date_format:Y-m-d'],
            'location_code' => ['required', 'string', 'max:6'],
            'persons' => ['required', 'integer'],
        ];
    }
}
