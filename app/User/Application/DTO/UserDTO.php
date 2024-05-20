<?php

namespace App\User\Application\DTO;

class UserDTO
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

}
