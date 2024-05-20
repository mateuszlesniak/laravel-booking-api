<?php

declare(strict_types=1);

namespace App\Reservation\UI\Controller\Request;

use Illuminate\Foundation\Http\FormRequest;

class SearchReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'numeric'],
        ];
    }
}
