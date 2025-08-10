<?php
require_once __DIR__ . '/JsonErrorResponder.php';

class ErrorHandler
{
    private static array $exceptionMap = [
        InvalidArgumentException::class => 400,
        RuntimeException::class         => 409,
    ];

    public static function handle(callable $callback): void
    {
        try {
            $callback();
        } catch (Throwable $e) {
            $status = self::$exceptionMap[get_class($e)] ?? 500;

            $message = ($status === 500)
                ? "Error interno del servidor."
                : $e->getMessage();

            JsonErrorResponder::send($message, $status);
        }
    }
}
