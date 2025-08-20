<?php

require_once __DIR__ . '/../utils/ValidationUtils.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../services/RoleService.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

$messages = require __DIR__ . '/../utils/Message.php';

class UserService {

    private UserRepository $repository;
    private RoleService $roleService;

    public function __construct() {
        $this->repository = new UserRepository();
        $this->roleService = new RoleService();
    }

    public function register(string $email, string $password): void {

        global $messages;
                
        validateEmail($email);
        validatePassword($password);

        $existing = $this->repository->existsByEmail($email);

        if ($existing) {
            throw new AlreadyExistsException(
                str_replace(
                    ':entity', 'Usuario', 
                    $messages['entity_already_exists']));   
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $defaultRole = $this->roleService->getByName('cliente');

        $role_id = $defaultRole->id;
        $user = new User($email, $hashedPassword, $role_id);

        $success = $this->repository->create($user);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getById(int $id): User {
        global $messages;

        ValidateId($id);

        $user = $this->repository->findById($id);

        if (!$user) {
            throw new NotFoundException(
                str_replace(
                    ':value', 'Usuario con ID ' . $id, 
                    $messages['not_found']));
        }

        return $user;
    }

    public function update(int $id, string $email, string $password, int $roleId): void {
        global $messages;

        validateEmail($email);
        validatePassword($password);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->roleService->getById($roleId);

        $user = new User($email, $hashedPassword, $roleId ,$id);

        $success = $this->repository->update($user);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function deleteById(int $id): void {
        global $messages;

        ValidateId($id);

        $user = $this->repository->findById($id);
                
        if (!$user) {
            throw new NotFoundException(
                str_replace(
                    ':value', 'Usuario con ID ' . $id, 
                    $messages['not_found']));
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        global $messages;
                
        validateParamPagination($offset, $limit);

        $roles = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();

        return [
            'data' => $roles,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

    public function changePassword(int $id, string $password): void {
        global $messages;

        validatePassword($password);

        $user = $this->repository->findById($id);
        if (!$user) {
            throw new NotFoundException($messages['not_found']);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $success = $this->repository->updatePassword($id, $hashedPassword);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function login(string $email, string $password): array {
        global $messages;

        validateEmail($email);
        validatePassword($password);

        $user = $this->repository->findByEmailFull($email);

        if (!$user) {
            throw new NotFoundException(
                str_replace(':value', 'Usuario con email ' . $email, $messages['not_found'])
            );
        }

        if (!password_verify($password, $user->password)) {
            throw new InvalidCredentials($messages['invalid_credentials']);
        }

        require_once __DIR__ . '/PersonService.php';
        $personService = new PersonService();
        try {
            $person = $personService->getByUserId($user->id);
            $id_person = $person->id;
        } catch (NotFoundException $e) {
            $id_person = null;
        }

        return [
            'user' => $user,
            'id_person' => $id_person
        ];
    }

    public function generateResetCode(string $email): array {
        global $messages;

        validateEmail($email);

        $user = $this->repository->findByEmailFull($email);

        if (!$user) {
            throw new NotFoundException(
                str_replace(':value', 'Usuario con email ' . $email, $messages['not_found'])
            );
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        require_once __DIR__ . '/PersonService.php';
        $personService = new PersonService();
        try {
            $person = $personService->getByUserId($user->id);
            $id_person = $person->id;
        } catch (NotFoundException $e) {
            $id_person = null;
        }

        return [
            'reset_code' => $code,
            'user'       => $user,
            'id_person'  => $id_person
        ];
    }



}