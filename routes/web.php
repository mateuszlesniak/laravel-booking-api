<?php

use App\Location\UI\Controller\GetLocationList;
use App\Reservation\UI\Controller\StoreReservation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('locations')->group(function () {
    Route::get('', GetLocationList::class);
});

Route::prefix('reservations')->group(function () {
    Route::get('', StoreReservation::class);
});
