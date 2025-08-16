<?php
require_once __DIR__ . '/../repositories/OrderRepository.php';
require_once __DIR__ . '/../repositories/ShoppingCarRepository.php';
require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';

$messages = require __DIR__ . '/../utils/Message.php';

class OrderService {
    private ShoppingCarRepository $carRepo;
    private OrderRepository $repository;
    private ProductRepository $productRepo;

    public function __construct() {
        $this->carRepo = new ShoppingCarRepository();
        $this->repository = new OrderRepository();
         $this->productRepo = new ProductRepository();
    }

   public function createFromCar(int $id_person): array {
        global $messages;

        $car = $this->carRepo->findByPersonId($id_person);
        if (!$car || $car->id_person !== $id_person) {
            throw new NotFoundException(
                str_replace(':value', 'Carrito', $messages['not_found'])
            );
        }

        $order = new Order(
            id_person: $id_person,
            products: $car->products,
            total_price: $car->total_price,
            created_at: date('Y-m-d H:i:s'),
            status: 'open'
        );

        $success = $this->repository->create($order);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }

        $this->carRepo->updateCar($car->id, [], 0);

        return [
            'id_person'   => $order->id_person,
            'products'    => $order->products,
            'total_price' => $order->total_price,
            'created_at'  => $order->created_at,
            'status'      => $order->status
        ];
}

     public function createFromSingleProduct(int $id_person, int $id_product): array {
        global $messages;

        $productDetails = $this->productRepo->getProductDetails($id_product);
        if (!$productDetails) {
            throw new NotFoundException(
                str_replace(':value', 'Producto', $messages['not_found'])
            );
        }

        $productsJson = [
            [
                'name'     => $productDetails['name'],
                'price'    => (int)$productDetails['price'],
                'quantity' => 1
            ]
        ];

        $totalPrice = (int)$productDetails['price'];

        $order = new Order(
            id_person: $id_person,
            products: $productsJson,
            total_price: $totalPrice,
            created_at: date('Y-m-d H:i:s'),
            status: 'open'
        );


        $success = $this->repository->create($order);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }

        return [
            'id_person'   => $order->id_person,
            'products'    => $order->products,
            'total_price' => $order->total_price,
            'created_at'  => $order->created_at,
            'status'      => $order->status
        ];
    }
    
     public function getOrder(int $id): ?Order {
        if ($id <= 0) {
             throw new NotFoundException(
                str_replace(':value', 'orden', $messages['not_found'])
            );
        }

        return $this->repository->findById($id);
    }

    public function changeOrderStatus(int $id, string $status): bool {
        $order = $this->repository->findById($id);
        return $this->repository->updateStatus($id, $status);
    }
}
