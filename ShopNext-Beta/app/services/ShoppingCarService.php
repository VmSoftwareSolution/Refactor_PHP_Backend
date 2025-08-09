<?php
// services/ShoppingCartService.php

require_once __DIR__ . '/../repositories/ShoppingCarRepository.php';
require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../models/ShoppingCar.php';

class ShoppingCarService {
    private ShoppingCarRepository $cartRepo;
    private ProductRepository $productRepo;

    public function __construct() {
        $this->repository = new ShoppingCarRepository();
        $this->productRepo = new ProductRepository();
    }

     public function createEmptyCar(int $idPerson): void {
        $shoppingCar = new ShoppingCar(
            id_person: $idPerson,
            products: [],
            total_price: 0.0
         );

        $this->repository->create($shoppingCar);
    }

    public function getCar(int $id_person): ?array {
        $cart = $this->repository->findByPersonId($id_person);
        return $cart ? [
            'id' => $cart->id,
            'id_person' => $cart->id_person,
            'total_price' => $cart->total_price,
            'products' => $cart->products
        ] : null;
    }

   public function addProduct(int $id_person, int $id_product): array {
    $cart = $this->repository->findByPersonId($id_person);
    if (!isset($cart->products) || !is_array($cart->products)) {
        $cart->products = [];
    }

    $productInfo = $this->productRepo->getProductDetails($id_product);
    if (!$productInfo) {
        throw new InvalidArgumentException("Producto no encontrado");
    }

    $newProduct = [
        'name'     => (string) $productInfo['name'],
        'quantity' => 1,
        'price'    => (int) $productInfo['price']
    ];

    if ($newProduct['price'] <= 0) {
        throw new InvalidArgumentException("El precio del producto no es válido");
    }

    if ($newProduct['name'] === '') {
        throw new InvalidArgumentException("El nombre del producto no puede estar vacío");
    }

    $found = false;
    foreach ($cart->products as &$item) {
        if ($item['name'] === $newProduct['name']) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $cart->products[] = $newProduct;
    }

    $cart->total_price = isset($cart->total_price) ? (int) $cart->total_price : 0;
    $cart->total_price += $newProduct['price'];

    $this->repository->updateCar($cart->id, $cart->products, $cart->total_price);

    return [
        'id'          => $cart->id,
        'id_person'   => $cart->id_person,
        'total_price' => $cart->total_price,
        'products'    => $cart->products
    ];
}

}
