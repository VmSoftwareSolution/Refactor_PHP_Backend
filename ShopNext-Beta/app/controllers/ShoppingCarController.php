<?php
// controllers/ShoppingCartController.php

require_once __DIR__ . '/../services/ShoppingCarService.php';
require_once __DIR__ . '/../utils/ErrorHandler.php';
require_once __DIR__ . '/../utils/JsonResponder.php';

class ShoppingCarController {
    private ShoppingCarService $service;

    public function __construct() {
        $this->service = new ShoppingCarService();
    }

    public function getCarByPersonId($data) {
       ErrorHandler::handle(function () use ($data) {
        $id_person = (int)($data['id_person'] ?? 0);
        $cart = $this->service->getCar($id_person);

        require __DIR__ . '/../views/shoppingCar/show.php';
    });
    }

    public function addForm() {
        require_once __DIR__ . '/../views/shoppingCar/add.php';
    }

    // Método que procesa la petición y llama al service
    public function addProductToCar(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $id_product = isset($data['id_product']) ? (int)$data['id_product'] : 0;

            if ($id_person <= 0 || $id_product <= 0) {
                throw new InvalidArgumentException("id_person e id_product son obligatorios y deben ser mayores a 0");
            }

            $result = $this->service->addProduct($id_person, $id_product);

            JsonResponder::success([
                'message' => 'Producto agregado correctamente al carrito',
                'cart' => $result
            ]);
        });
    }

}
