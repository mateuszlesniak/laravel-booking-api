<?php

use App\Location\UI\Controller\GetLocationList;
use App\Reservation\UI\Controller\CreateReservation;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')->group(function () {
    Route::get('', GetLocationList::class);
});

Route::prefix('reservations')->group(function () {
    Route::post('', CreateReservation::class);
});
