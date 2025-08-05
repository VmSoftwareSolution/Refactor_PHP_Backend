<?php

require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';
require_once __DIR__ . '/../models/Product.php';

class ProductService {

    private ProductRepository $repository;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    public function create(string $name, string $description, int $price, int $stock, ?string $category = null, ?string $image = null): void {

        validateString($name, 'name');
        validateString($description, 'description');
        validateNonNegativeInt($price, 'price');
        validateNonNegativeInt($stock, 'stock');

        if ($this->repository->existsByName($name)) {
            throw new InvalidArgumentException("Ya existe un producto con ese nombre.");
        }

        $product = new Product($name, $description, $price, $stock, $category, $image);
        $success = $this->repository->create($product);

        if (!$success) {
            throw new RuntimeException("Error al crear el producto.");
        }
    }
}
