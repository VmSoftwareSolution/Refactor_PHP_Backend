<?php

require_once __DIR__ . '/../services/FavoriteService.php';
require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../utils/JsonResponder.php';

$messages = require __DIR__ . '/../utils/Message.php';


class FavoriteController {
    private FavoriteService $service;

    public function __construct() {
        $this->service = new FavoriteService();
    }

    public function getMyFav($data) {
       ErrorHandler::handle(function () use ($data) {
        $id_person = (int)($data['id_person'] ?? 0);
        $fav = $this->service->getFavs($id_person);

        require __DIR__ . '/../views/favorites/show.php';
    });
    }

   public function addForm() {
        ErrorHandler::handle(function () {
            require_once __DIR__ . '/../services/PersonService.php';
            $personService = new PersonService();
            $personsResult = $personService->getAll(PHP_INT_MAX, 0);
            $persons = $personsResult['data'];

            require_once __DIR__ . '/../services/ProductService.php';
            $productService = new ProductService();
            $productsResult = $productService->getAll(PHP_INT_MAX, 0);
            $products = $productsResult['data'];

            require_once __DIR__ . '/../views/favorites/add.php';
        });
    }



    public function addToFavs(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $id_product = isset($data['id_product']) ? (int)$data['id_product'] : 0;

            $result = $this->service->addProduct($id_person, $id_product);

            JsonResponder::success([
                'message' => 'Producto agregado correctamente a lista de favoritos',
                'fav' => $result
            ]);
        });
     }

     public function removeFromFavs(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $name = isset($data['name']) ? (string)$data['name'] : 0;

            $result = $this->service->removeProduct($id_person, $name);

            JsonResponder::success([
                'message' => $messages['deleted_successfully'],
                'fav' => $result
            ]);
        });
    }

}