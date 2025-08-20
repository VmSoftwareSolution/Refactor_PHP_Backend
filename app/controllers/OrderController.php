<?php
require_once __DIR__ . '/../services/OrderService.php';
require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../utils/JsonResponder.php';
require_once __DIR__ . '/../services/PersonService.php'; 
require_once __DIR__ . '/../services/ShoppingCarService.php'; 

$messages = require __DIR__ . '/../utils/Message.php';

class OrderController {
    private OrderService $service;

    public function __construct() {
        $this->service = new OrderService();
    }

    public function fromCar() {
        ErrorHandler::handle(function () {
            $id_person = isset($_GET['id_person']) ? (int)$_GET['id_person'] : 1; 
            
            $personService = new PersonService();
            $personsResult = $personService->getAll(PHP_INT_MAX, 0);
            $persons = $personsResult['data'];
            
            $shoppingCarService = new ShoppingCarService();
            $car = $shoppingCarService->getCarByPersonId($id_person);

            require_once __DIR__ . '/../views/orders/fromCar.php';
        });
    }


    public function OrderFromCar(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;

            if ($id_person <= 0) {
                throw new InvalidArgumentException("id_person es obligatorio y debe ser mayor que 0");
            }

            $result = $this->service->createFromCar($id_person);

            JsonResponder::success([
                'status' => 200,
                'message' => 'Orden creada exitosamente',
                'car' => $result
            ]);
        });
    }

    public function fromProduct() {
        $id_product = isset($_GET['id_product']) ? (int)$_GET['id_product'] : null;
        
        require_once __DIR__ . '/../services/ProductService.php';
        $productService = new ProductService();
        
        $product = $productService->getById($id_product);

        require_once __DIR__ . '/../services/PersonService.php';
        $personService = new PersonService();
        $personsResult = $personService->getAll(PHP_INT_MAX, 0);
        $persons = $personsResult['data'];
        
        require_once __DIR__ . '/../views/orders/fromProduct.php';
    }


    public function OrderFromProduct(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $id_product = isset($data['id_product']) ? (int)$data['id_product'] : 0;
            $result = $this->service->createFromSingleProduct($id_person, $id_product);

            JsonResponder::success([
                'message' => 'Orden creada exitosamente',
                'product' => $result
            ]);
        });
    }

   public function getOrderById($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int)($data['id'] ?? 0);
            $order = $this->service->getOrder($id);

            require __DIR__ . '/../views/orders/show.php';
        });
    }

    public function updateStatus(?array $data = null): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            if (!$data) {
                $data = json_decode(file_get_contents('php://input'), true);
            }
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            $status = isset($data['status']) ? (string)$data['status'] : '';

            $result = $this->service->changeOrderStatus($id, $status);

            JsonResponder::success([
                'message' => $messages['updated_successfully'],
                'order' => $result
            ]);
        });
    }


    public function listOrders() {
        ErrorHandler::handle(function () {
            $orders = $this->service->getAllOrders();
            require_once __DIR__ . '/../views/orders/list.php';
        });
    }



}