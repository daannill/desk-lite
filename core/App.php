<?php

declare(strict_types=1);

namespace Core;

use App\Middlewares\AppMiddleware;
use Support\Abort;

class App {

    public function __construct() {
        Middleware::register(AppMiddleware::class);

        require APP_PATH . '/routes/web.php';

        $url = trim($_GET['url'] ?? '', '/');
        $requestMethod = Request::method();

        foreach (Routes::$routes as $routeData) {
            if ($requestMethod !== $routeData['method']) {
                continue;
            }

            $route = $routeData['route'];

            if (strpos($route, '{') === false) {
                if ($url === $route) {
                    $this->runAction($routeData['action']);
                    return;
                }

                continue;
            }

            preg_match_all(
                '/\{([a-zA-Z0-9_]+)\}/',
                $route,
                $paramNames
            );

            $pattern = preg_replace(
                '/\{([a-zA-Z0-9_]+)\}/',
                '([^/]+)',
                $route
            );

            $pattern = "#^{$pattern}$#";

            if (!preg_match($pattern, $url, $matches)) {
                continue;
            }

            array_shift($matches);

            $params = array_combine($paramNames[1], $matches) ?: [];

            $this->runAction($routeData['action'], $params);
            return;
        }

        Abort::error(404);
    }

    private function runAction(array $action, array $params = []): void {
        [$controllerName, $method] = $action;

        if (!class_exists($controllerName)) {
            Abort::error(500, "Controller [$controllerName] not found.");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            Abort::error(500, "Method [$method] not found in controller [$controllerName].");
        }

        $controller->runMiddleware($method);

        call_user_func([$controller, $method], $params);
    }
}