<?php

class Product {
    public ?int $id;
    public string $name;
    public string $description;
    public int $price;
    public int $stock;
    public ?string $category;
    public ?string $image;

    public function __construct(
        string $name,
        string $description,
        int $price,
        int $stock,
        ?string $category = null,
        ?string $image = null, 
        ?int $id = null
        ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->category = $category;
        $this->image = $image;
        $this->id = $id;
    }
}