<?php

use App\Location\UI\Controller\GetLocationList;
use App\Reservation\UI\Controller\CreateReservation;
use App\Reservation\UI\Controller\GetReservationList;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')->group(function () {
    Route::get('', GetLocationList::class);
});

Route::prefix('reservations')->group(function () {
    Route::get('', GetReservationList::class);
    Route::post('', CreateReservation::class);
});
