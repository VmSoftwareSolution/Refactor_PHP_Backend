<?php
require_once __DIR__ . '/../repositories/PersonRepository.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Person.php';
require_once __DIR__ . '/../services/ShoppingCarService.php';
require_once __DIR__ . '/../services/FavoriteService.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';

$messages = require __DIR__ . '/../utils/Message.php';

class PersonService {
    private PersonRepository $repository;
    private UserRepository $userRepository;
    private ShoppingCarService $shoppingCarService; 
    private FavoriteService $favService;

    public function __construct() {
        $this->repository = new PersonRepository();
        $this->userRepository = new UserRepository();
        $this->favService = new FavoriteService();
        $this->shoppingCarService = new ShoppingCarService(); 
    }

    public function getById(int $id): Person {
        global $messages;

        validateId($id);

        $person = $this->repository->findById($id);
        if (!$person) {
            throw new UnexcpectedErrorException(
                $messages['unexpected_error']);
        }
        return $person;
    }

    public function getAll(int $limit = 100, int $offset = 0): array {

        ValidateParamPagination($offset, $limit);

        $persons = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();
        return [
            'data' => $persons,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

    public function create(array $data): void {
        global $messages;
        
        IsNotEmpty($data['full_name'] ?? '', 'full_name');
        IsNotEmpty($data['id_user'] ?? '', 'id_user');
      
        $id_user = (int)$data['id_user'];

        if ($this->repository->existsByUserId($id_user)) {
            throw new AlreadyExistsException(str_replace(
                    ':entity', 'Usuario', 
                    $messages['entity_already_exists']));
        }


        if (!$this->userRepository->findById($id_user)) {
            throw new NotFoundException( 
                    str_replace(
                        ':value', 'Usuario con ID' . $id_user, 
                        $messages['not_found']));
        }

        $person = new Person(
            $data['full_name'],
            $id_user,
            $data['phone'] ?? null,
            $data['gender'] ?? null,
            $data['date_of_birth'] ?? null,
            $data['avatar'] ?? null
        );

        $success = $this->repository->create($person);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }

        $idPerson = $this->repository->getLastInsertId(); 
        $this->shoppingCarService->createEmptyCar($idPerson);
        $this->favService->createEmptyFav($idPerson);
    }

    public function update(int $id, array $data): void {
        global $messages;

        ValidateId($id);

        $existing = $this->repository->findById($id);

        if (!$existing) {
            throw new NotFoundException( 
                    str_replace(
                        ':value', 'Persona con ID' . $id, 
                        $messages['not_found']));
        }

        $full_name = $data['full_name'] ?? $existing->full_name;
        $id_user = isset($data['id_user']) ? (int)$data['id_user'] : $existing->id_user;

        
        $phone = $data['phone'] ?? $existing->phone;
        $gender = $data['gender'] ?? $existing->gender;
        $date_of_birth = $data['date_of_birth'] ?? $existing->date_of_birth;
        $avatar = $data['avatar'] ?? $existing->avatar;

        $person = new Person(
            $full_name,
            $id_user,
            $phone,
            $gender,
            $date_of_birth,
            $avatar,
            $id,
            $existing->create_at
        );

        $success = $this->repository->update($person);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function deleteById(int $id): void {
        global $messages;

        ValidateId($id);

        $existing = $this->repository->findById($id);

        if (!$existing) {
            throw new NotFoundException( 
                    str_replace(
                        ':value', 'Usuario con ID' . $id_user, 
                        $messages['not_found']));
        }
        $success = $this->repository->deleteById($id);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getByUserId(int $id_user): Person {
        global $messages;

        validateId($id_user);

        $person = $this->repository->findByUserId($id_user);

        if (!$person) {
            throw new NotFoundException(
                str_replace(':value', 'Persona con ID de usuario ' . $id_user, $messages['not_found'])
            );
        }

        return $person;
    }

}
