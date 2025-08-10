<?php
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
            total_price: 0
         );

        $this->repository->create($shoppingCar);
    }

    public function getCar(int $id_person): ?array {
        $car = $this->repository->findByPersonId($id_person);
        return $car ? [
            'id' => $car->id,
            'id_person' => $car->id_person,
            'total_price' => $car->total_price,
            'products' => $car->products
        ] : null;
    }

   public function addProduct(int $id_person, int $id_product): array {
    $car = $this->repository->findByPersonId($id_person);
    if (!isset($car->products) || !is_array($car->products)) {
        $car->products = [];
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
    foreach ($car->products as &$item) {
        if ($item['name'] === $newProduct['name']) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $car->products[] = $newProduct;
    }

    $car->total_price = isset($car->total_price) ? (int) $car->total_price : 0;
    $car->total_price += $newProduct['price'];

    $this->repository->updateCar($car->id, $car->products, $car->total_price);

    return [
        'id'          => $car->id,
        'id_person'   => $car->id_person,
        'total_price' => $car->total_price,
        'products'    => $car->products
    ];
}

    public function updateProductQuantity(int $id_person, string $name, int $quantity): array {

        $car = $this->repository->findByPersonId($id_person);
        $updatedProducts = [];
        $totalPrice = 0;

        foreach ($car->products as $item) {
            if ($item['name'] === $name) {
                if ($quantity > 0) {
                    $item['quantity'] = $quantity;
                    $updatedProducts[] = $item;
                }
            } else {
                $updatedProducts[] = $item;
            }
        }

        foreach ($updatedProducts as $prod) {
            $totalPrice += $prod['price'] * $prod['quantity'];
        }

        $car->products = array_values($updatedProducts);
        $car->total_price = $totalPrice;

        $this->repository->updateCar($car->id, $car->products, $car->total_price);

        return [
            'id'          => $car->id,
            'id_person'   => $car->id_person,
            'total_price' => $car->total_price,
            'products'    => $car->products
        ];
    }


}
