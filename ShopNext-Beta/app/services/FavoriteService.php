<?php
require_once __DIR__ . '/../repositories/FavoriteRepository.php';
require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../models/Favorite.php';

class FavoriteService {
    private FavoriteRepository $repository;
    private ProductRepository $productRepo;

    public function __construct() {
        $this->repository = new FavoriteRepository();
        $this->productRepo = new ProductRepository();
    }

     public function createEmptyFav(int $idPerson): void {
        $fav = new Favorite(
            id_person: $idPerson,
            products: [],
         );

        $this->repository->create($fav);
    }

    public function getFavs(int $id_person): ?array {
        $fav = $this->repository->findByPersonId($id_person);
        return $fav ? [
            'id' => $fav->id,
            'id_person' => $fav->id_person,
            'products' => $fav->products
        ] : null;
    }

    public function addProduct(int $id_person, int $id_product): array {
    $fav = $this->repository->findByPersonId($id_person);
    if (!isset($fav->products) || !is_array($fav->products)) {
        $fav->products = [];
    }

    $productInfo = $this->productRepo->getProductDetails($id_product);
    if (!$productInfo) {
        throw new InvalidArgumentException("Producto no encontrado");
    }

    $newProduct = [
        'name'     => (string) $productInfo['name'],
        'price'    => (int) $productInfo['price']
    ];

    $found = false;
    foreach ($fav->products as &$item) {
        if ($item['name'] === $newProduct['name']) {
            throw new InvalidArgumentException("El producto ya se encuentra en la lista.");
        }
    }

    if (!$found) {
        $fav->products[] = $newProduct;
    }


    $this->repository->updateFav($fav->id, $fav->products);

    return [
        'id'          => $fav->id,
        'id_person'   => $fav->id_person,
        'products'    => $fav->products
    ];
    }
    public function removeProduct(int $id_person, string $name): array {
        $fav = $this->repository->findByPersonId($id_person);
      
        $updatedProducts = array_filter($fav->products, function ($item) use ($name) {
            return $item['name'] !== $name;
        });

    
        if (count($updatedProducts) === count($fav->products)) {
            throw new InvalidArgumentException("El producto no se encuentra en la lista.");
        }
    
        $fav->products = array_values($updatedProducts);
        $this->repository->updateFav($fav->id, $fav->products);

        return [
            'id'        => $fav->id,
            'id_person' => $fav->id_person,
            'products'  => $fav->products
        ];
    }

}