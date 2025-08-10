<?php

require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Role.php';

$messages = require __DIR__ . '/../utils/Message.php';

class ProductService {
    private ProductRepository $repository;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    public function create(
        string $name, 
        string $description, 
        int $price, 
        int $stock, 
        ?string $category = null, 
        ?string $image = null
    ): void {
        global $messages;

        IsNotEmpty($name, 'name');
        IsNotEmpty($description, 'description');
        IsNotNegativeNumber($price, 'price');
        IsNotNegativeNumber($stock, 'stock');

        if ($this->repository->existsByName($name)) {
            throw new AlreadyExistsException(
                str_replace(
                    ':entity', 'Producto', 
                    $messages['entity_already_exists'])); 
        }

        $product = new Product($name, $description, $price, $stock, $category, $image);
        $success = $this->repository->create($product);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

     public function getById(int $id): Product {
        global $messages;

        ValidateId($id);

        $product = $this->repository->findById($id);

        if (!$product) {
            throw new NotFoundException(
                str_replace(
                    ':value', 'Producto con ID ' . $id, 
                    $messages['not_found']));
        }

        return $product;
    }

    public function deleteById(int $id): void {
        global $messages;

        ValidateId($id);
  

        $product = $this->repository->findById($id);
        if (!$product) {
            throw new NotFoundException(
                str_replace(
                    ':value', 'Producto con ID ' . $id, 
                    $messages['not_found']));
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function update(
        int $id, 
        string $name, 
        string $description, 
        int $price, 
        int $stock, 
        ?string $category = null, 
        ?string $image = null
    ): void {
        global $messages;
        
        IsNotEmpty($name, 'name');
        IsNotEmpty($description, 'description');
        IsNotNegativeNumber($price, 'price');
        IsNotNegativeNumber($stock, 'stock');

       if ($this->repository->existsByName($name)) {
            throw new AlreadyExistsException(
                str_replace(
                    ':entity', 'Usuario', 
                    $messages['entity_already_exists']));   
        }

        $product = new Product($name, $description, $price, $category, $image, $id);
        $success = $this->repository->update($product);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        global $messages;
        
        validateParamPagination($offset, $limit);

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
