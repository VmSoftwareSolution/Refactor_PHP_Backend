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
        error_log("[ProductService] Service initialized");
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

        error_log("[ProductService][create] name=$name, description=$description, price=$price, stock=$stock, category=$category, image=$image");

        IsNotEmpty($name, 'name');
        IsNotEmpty($description, 'description');
        IsNotNegativeNumber($price, 'price');
        IsNotNegativeNumber($stock, 'stock');

        if ($this->repository->existsByName($name)) {
            error_log("[ProductService][create] Producto duplicado: $name");
            throw new AlreadyExistsException(
                str_replace(':entity', 'Producto', $messages['entity_already_exists'])
            ); 
        }

        $product = new Product($name, $description, $price, $stock, $category, $image);
        error_log("[ProductService][create] Creando producto -> " . print_r($product, true));

        $success = $this->repository->create($product);

        if (!$success) {
            error_log("[ProductService][create] ERROR inesperado al guardar producto");
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getById(int $id): Product {
        global $messages;

        error_log("[ProductService][getById] id=$id");

        ValidateId($id);

        $product = $this->repository->findById($id);

        if (!$product) {
            error_log("[ProductService][getById] Producto no encontrado con id=$id");
            throw new NotFoundException(
                str_replace(':value', 'Producto con ID ' . $id, $messages['not_found'])
            );
        }

        return $product;
    }

    public function deleteById(int $id): void {
        global $messages;

        error_log("[ProductService][deleteById] id=$id");

        ValidateId($id);

        $product = $this->repository->findById($id);
        if (!$product) {
            error_log("[ProductService][deleteById] Producto no existe id=$id");
            throw new NotFoundException(
                str_replace(':value', 'Producto con ID ' . $id, $messages['not_found'])
            );
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            error_log("[ProductService][deleteById] ERROR inesperado al eliminar id=$id");
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

        if ($this->repository->existsByName($name, $id ?? null)) {
            throw new AlreadyExistsException(
                str_replace(':entity', 'Producto', $messages['entity_already_exists'])
            );   
        }

        $product = new Product($name, $description, $price, $stock, $category, $image, $id);

        $success = $this->repository->update($product);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        global $messages;
        
        error_log("[ProductService][getAll] limit=$limit, offset=$offset");

        validateParamPagination($offset, $limit);

        $products = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();

        error_log("[ProductService][getAll] encontrados=" . count($products));

        return [
            'data' => $products,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }
}
