<?php

class Favorite {
    public int $id;
    public int $id_person;
    public array $products;

    public function __construct(int $id_person, array $products = [], ?int $id = 0) {
        $this->id_person = $id_person;
        $this->products = $products;
        $this->id = $id;
    }
}
