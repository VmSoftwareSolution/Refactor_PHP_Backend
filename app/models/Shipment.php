<?php

class Shipment {
    public ?int $id;
    public int $id_order;
    public string $address;
    public string $status;
    public string $created_at;

    public function __construct(
        ?int $id,
        int $id_order,
        string $address,
        string $status,
        string $created_at
    ) {
        $this->id        = $id;
        $this->id_order  = $id_order;
        $this->address   = $address;
        $this->status    = $status;
        $this->created_at = $created_at;
    }
}