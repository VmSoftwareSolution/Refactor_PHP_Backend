<?php

require_once 'routes/web.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

foreach ($routes as $route => [$method, $handler]) {
    if ($route === $requestUri && $method === $requestMethod) {
        [$controllerName, $function] = explode('@', $handler);
        require_once "app/controllers/{$controllerName}.php";
        $controller = new $controllerName();
        $controller->$function($_REQUEST);
        exit;
    }
}

http_response_code(404);
echo "Route not found.";
