<?php

use App\Booking\GetLocationList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('locations')->group(function () {
    Route::get('', GetLocationList::class);
});
