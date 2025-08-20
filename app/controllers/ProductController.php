<?php

require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../services/ProductService.php'; 
require_once __DIR__ . '/../utils/JsonResponder.php';

$messages = require __DIR__ . '/../utils/Message.php';

class ProductController {

    private ProductService $service;

    function __construct(){
        $this->service = new ProductService();
    }

    public function create() {
        require_once __DIR__ . '/../views/products/create.php';
    }

    public function createProduct(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';
            $price = isset($data['price']) ? (int)$data['price'] : -1;
            $stock = isset($data['stock']) ? (int)$data['stock'] : -1;
            $category = $data['category'] ?? null;
            $image = $data['image'] ?? null;

            $this->service->create($name, $description, $price, $stock, $category, $image);
            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }

     public function getProductById($data) {

        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $product = $this->service->getById($id);
            require_once __DIR__ . '/../views/products/show.php';
        });

    }

    public function deleteProduct($data) {
        global $messages;

        ErrorHandler::handle(function () use ($messages) {
            $id = (int) ($_POST['id'] ?? 0);
            if ($id <= 0) {
                throw new InvalidArgumentException("ID inválido");
            }

            $this->service->deleteById($id);

            JsonResponder::success([
                'status' => 200,
                'message' => $messages['deleted_successfully'],
            ]);
        });
    }


    public function editProduct($data) {

         ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $product = $this->service->getById($id);
            require_once __DIR__ . '/../views/products/edit.php';
        });

    }

    public function updateProduct($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
        $id = (int) ($data['id'] ?? 0);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = isset($data['price']) ? (int)$data['price'] : -1;
        $stock = isset($data['stock']) ? (int)$data['stock'] : -1;
        $category = $data['category'] ?? null;
        $image = $data['image'] ?? null;

        $this->service->update($id, $name, $description, $price, $stock, $category, $image);
              JsonResponder::success([
                'status' => 200,
                'message' => $messages['updated_successfully'],
            ]);
        });
    }

    public function listProducts(array $data): void{

    ErrorHandler::handle(function () use ($data) {
        $limit = isset($data['limit']) ? (int) $data['limit'] : 100;
        $offset = isset($data['offset']) ? (int) $data['offset'] : 0;

        $result = $this->service->getAll($limit, $offset);

        $payload = array_map(function ($product) {
            return [
                'id' => $product->id,
                'Nombre: ' => $product->name,
                'Descipción:' => $product->description,
                'Precio:' => $product->price,
                'Categoría:' => $product->category,
                'Imagen:' => $product->image,
            ];
        }, $result['data']);

        JsonResponder::success([
            'data' => $payload,
            'total' => $result['total'],
            'limit' => $result['limit'],
            'offset' => $result['offset'],
            'count' => count($payload),
        ]);
    });
    }

    public function listProductsView(array $data = []): void {
        ErrorHandler::handle(function () use ($data) {
            $productsObjects = $this->service->getAll(); 

            $products = array_map(function($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'price' => $p->price,
                    'stock' => $p->stock,
                    'category' => $p->category,
                    'image' => $p->image,
                ];
            }, $productsObjects['data'] ?? []);

            require_once __DIR__ . '/../views/products/list.php';
        });
    }

    public function showProductosdashboard(array $data = []){
        ErrorHandler::handle(function () use ($data) {
            $productsObjects = $this->service->getAll(); 

            $products = array_map(function($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'price' => $p->price,
                    'stock' => $p->stock,
                    'category' => $p->category,
                    'image' => $p->image,
                ];
            }, $productsObjects['data'] ?? []);

            require_once __DIR__ . '/../views/products/productosShow.php';
        });
    }
   
}
