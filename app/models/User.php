<?php

class User {
    public ?int $id;
    public string $email;
    public string $password;
    public int $role_id;

    public function __construct(string $email, string $password, int $role_id, ?int $id = null) {
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->id = $id;
    }
}
