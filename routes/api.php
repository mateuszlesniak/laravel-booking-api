<?php

use App\Booking\CreateReservation;
use App\Booking\GetLocationList;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')->group(function () {
    Route::get('', GetLocationList::class);
});

Route::prefix('reservations')->group(function () {
    Route::post('', CreateReservation::class);
});
