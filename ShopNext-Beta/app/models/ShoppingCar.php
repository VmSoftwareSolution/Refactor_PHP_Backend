<?php

class ShoppingCar {
  public int $id;
    public int $id_person;
    public int $total_price;
    public array $products; // [{name, image, quantity, price}]

    public function __construct(int $id_person, array $products = [], int $total_price = 0, ?int $id = 0) {
        $this->id_person = $id_person;
        $this->products = $products;
        $this->total_price = $total_price;
        $this->id = $id;
    }
}
