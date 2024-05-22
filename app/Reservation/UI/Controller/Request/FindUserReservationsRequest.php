<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Request;

use Illuminate\Foundation\Http\FormRequest;

class FindUserReservationsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => ['date', 'date_format:Y-m-d'],
            'end_date' => ['date', 'date_format:Y-m-d'],
            'location_code' => ['string', 'max:6'],
            'user_id' => ['integer'],
        ];
    }
}
