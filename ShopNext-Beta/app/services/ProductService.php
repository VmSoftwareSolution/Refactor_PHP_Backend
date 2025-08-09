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

     public function getById(int $id): Product {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $product = $this->repository->findById($id);

        if (!$product) {
            throw new InvalidArgumentException("producto no encontrado.");
        }

        return $product;
    }

    public function deleteById(int $id): void {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $product = $this->repository->findById($id);
        if (!$product) {
            throw new InvalidArgumentException("Rol no encontrado.");
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new RuntimeException("No se pudo eliminar el rol.");
        }
    }

    public function update(int $id, string $name, string $description, int $price, int $stock, ?string $category = null, ?string $image = null): void {
        
        validateString($name, 'name');
        validateString($description, 'description');
        validateNonNegativeInt($price, 'price');
        validateNonNegativeInt($stock, 'stock');

       if ($this->repository->existsByName($name)) {
            throw new InvalidArgumentException("Ya existe un producto con ese nombre.");
        }

        $product = new Product($name, $description, $price, $category, $image, $id);
        $success = $this->repository->update($product);

        if (!$success) {
            throw new RuntimeException("Error al actualizar el usuario.");
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        if ($limit <= 0 || $offset < 0) {
            throw new InvalidArgumentException("Parámetros de paginación inválidos.");
        }

        $products = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();

        return [
            'data' => $products,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

}
