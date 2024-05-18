<?php

namespace App\Booking;

enum RoomStatus
{
    case AVAILABLE;
    case RESERVED;
    case OCCUPIED;
    case UNAVAILABLE;

}
