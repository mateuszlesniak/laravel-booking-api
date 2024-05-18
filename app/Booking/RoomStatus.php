<?php

namespace App\Booking;

enum RoomStatus
{
    case AVAILABLE;
    case RESERVED;
    case OCCUPIED;
    case UNAVAILABLE;

    public static function isAvailable(RoomStatus $status): bool
    {
        return in_array($status, self::getAvailableStatusList());
    }

    private static function getAvailableStatusList(): array
    {
        return [
            self::AVAILABLE,
        ];
    }
}
