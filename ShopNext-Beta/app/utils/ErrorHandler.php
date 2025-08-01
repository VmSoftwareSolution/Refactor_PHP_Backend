<?php

class ErrorHandler {
    
    public static function handle(callable $callback): void {
        try {
            $callback();
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (RuntimeException $e) {
            http_response_code(409);
            echo $e->getMessage();
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error interno del servidor.";
        }
    }
}
