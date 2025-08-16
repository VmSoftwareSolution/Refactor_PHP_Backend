<?php

class Order {
    public int $id;
    public int $id_person;
    public int $total_price;
    public array $products;
    public string $created_at;
    public string $status;

    public function __construct(
        int $id_person,
        string $status,                
        array $products = [],
        int $total_price = 0,
        ?string $created_at = null,
        ?int $id = 0
    ) {
        $this->id_person = $id_person;
        $this->status = $status;
        $this->products = $products;
        $this->total_price = $total_price;
        $this->created_at = $created_at;
        $this->id = $id;
    }

}