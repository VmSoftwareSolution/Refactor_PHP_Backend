<?php

require_once __DIR__ . '/../utils/ErrorHandler.php';
require_once __DIR__ . '/../services/ProductService.php'; 

class ProductController {

    private ProductService $service;

    function __construct(){
        $this->service = new ProductService();
    }

    public function create() {
        require_once __DIR__ . '/../views/products/create.php';
    }

    public function createProduct(array $data): void {
    ErrorHandler::handle(function () use ($data) {
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = isset($data['price']) ? (int)$data['price'] : -1;
        $stock = isset($data['stock']) ? (int)$data['stock'] : -1;
        $category = $data['category'] ?? null;
        $image = $data['image'] ?? null;

        $this->service->create($name, $description, $price, $stock, $category, $image);
        echo "Producto creado exitosamente.";
    });
}
}