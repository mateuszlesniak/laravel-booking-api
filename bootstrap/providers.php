<?php

return [
    \App\Common\Application\Provider\AppServiceProvider::class,
    \App\Reservation\Application\Provider\ReservationServiceProvider::class,
    \App\Location\Infrastructure\Provider\LocationServiceProvider::class,
    \App\User\Application\Provider\UserServiceProvider::class,
];
