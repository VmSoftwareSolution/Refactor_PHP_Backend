<?php

require_once __DIR__ . '/../repositories/PayloadRepository.php';
require_once __DIR__ . '/../models/Payload.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';

$messages = require __DIR__ . '/../utils/Message.php';

class PayloadService {

    private PayloadRepository $repository;

    public function __construct() {
        $this->repository = new PayloadRepository();
    }

    public function create(int $id_order, string $method): void {
        global $messages;
        $status = 'in_progress';

        $payment_at = date('Y-m-d H:i:s');

        $payload = new Payload(
            id_order: $id_order,
            method: $method,
            status: $status,
            payment_at: $payment_at);
        $success = $this->repository->create($payload);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getPayload(int $id): ?Payload {
        if ($id <= 0) {
             throw new NotFoundException(
                str_replace(':value', 'Pago', $messages['not_found'])
            );
        }

        return $this->repository->findById($id);
    }

    public function changePayloadStatus(int $id, string $status): bool {
        return $this->repository->updateStatus($id, $status);
    }
}