<?php

class UserDTO
{
    public readonly int $id;
    public readonly string $email;
    public readonly string $username;

    public function __construct(int $id, string $email, string $username)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
    }
}
