<?php

class Person {
    public ?int $id;
    public string $full_name;
    public ?string $phone;
    public ?string $gender;
    public ?string $date_of_birth;
    public ?string $avatar;
    public ?string $create_at;
    public int $id_user;

    public function __construct(
        string $full_name,
        int $id_user,
        ?string $phone = null,
        ?string $gender = null,
        ?string $date_of_birth = null,
        ?string $avatar = null,
        ?int $id = null,
        ?string $create_at = null
    ) {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->avatar = $avatar;
        $this->create_at = $create_at;
        $this->id_user = $id_user;
    }
}
