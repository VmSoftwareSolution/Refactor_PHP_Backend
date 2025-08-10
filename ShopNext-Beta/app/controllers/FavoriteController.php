<?php

require_once __DIR__ . '/../services/FavoriteService.php';
require_once __DIR__ . '/../utils/ErrorHandler.php';
require_once __DIR__ . '/../utils/JsonResponder.php';

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
        require_once __DIR__ . '/../views/favorites/add.php';
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
        ErrorHandler::handle(function () use ($data) {
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : 0;
            $name = isset($data['name']) ? (string)$data['name'] : 0;

            $result = $this->service->removeProduct($id_person, $name);

            JsonResponder::success([
                'message' => 'Producto eliminado correctamente de la lista de favoritos',
                'fav' => $result
            ]);
        });
    }

}