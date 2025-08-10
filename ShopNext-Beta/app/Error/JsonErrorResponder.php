<?php
class JsonErrorResponder
{
    public static function send(string $message, int $code = 500): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);

        echo json_encode([
            'error' => $message,
            'code'  => $code
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
