<?php
require_once __DIR__ . '/../services/ShoppingCarService.php';
require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../utils/JsonResponder.php';

$messages = require __DIR__ . '/../utils/Message.php';

class ShoppingCarController {
    private ShoppingCarService $service;

    public function __construct() {
        $this->service = new ShoppingCarService();
    }

    public function getCarByPersonId($data) {
       ErrorHandler::handle(function () use ($data) {
        $id_person = (int)($data['id_person'] ?? 0);
        $car = $this->service->getCar($id_person);

        require __DIR__ . '/../views/shoppingCar/show.php';
    });
    }

    public function addForm() {
        require_once __DIR__ . '/../views/shoppingCar/add.php';
    }

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
                'car' => $result
            ]);
        });
    }
    public function updateMyCar(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data,$messages) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $name = isset($data['name']) ? (string)$data['name'] : 0;
            $quantity = isset($data['quantity']) ? (int)$data['quantity'] : 0;

            $result = $this->service->updateProductQuantity($id_person, $name, $quantity);

            JsonResponder::success([
                'message' => $messages['updated_successfully'],
                'car' => $result
            ]);
        });
}
}