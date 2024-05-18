<?php

namespace App\Booking;

enum RoomType: int
{
    case SINGLE = 1;
    case DOUBLE = 2;
    case TRIPLE = 3;
}
