<?php
require_once __DIR__ . '/../utils/JsonResponder.php';

class ErrorHandler
{
    private static array $exceptionMap = [
        RuntimeException::class         => 409,
        EmailRequiredException::class   => 400,
        InvalidEmailFormatException::class => 400,
        PasswordRequiredException::class => 400,
        WeakPasswordException::class    => 400,
        EmptyFieldException::class       => 400,
        NegativeValueException::class    => 400,
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

            JsonResponder::error($message, $status);
        }
    }
}
