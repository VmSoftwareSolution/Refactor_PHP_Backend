<?php

class User {

    public $id;
    public $email;
    public $password;
    public $role_id;

    public function __construct(
        string $email,
        string $password,
        int $role_id,
        int $id = null
    ){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
    }

}