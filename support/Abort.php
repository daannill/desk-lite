<?php

declare(strict_types=1);

namespace Support;

class Abort {

    public static function error(int $code = 404, string $message = ''): void {
        $allowedCodes = [403, 404, 500];

        if (!in_array($code, $allowedCodes, true)) {
            $code = 500;
        }

        http_response_code($code);

        // 1. Check userland custom view in app/views/errors/
        $view = defined('APP_PATH') ? APP_PATH . "/app/views/errors/$code.php" : dirname(__DIR__) . "/app/views/errors/$code.php";

        // 2. Fallback to default framework error view in support/views/errors/
        if (!file_exists($view)) {
            $view = defined('APP_PATH') ? APP_PATH . "/support/views/errors/$code.php" : dirname(__DIR__) . "/support/views/errors/$code.php";
        }

        // 3. Last resort fallback
        if (!file_exists($view)) {
            $view = defined('APP_PATH') ? APP_PATH . "/support/views/errors/500.php" : dirname(__DIR__) . "/support/views/errors/500.php";
        }

        if (file_exists($view)) {
            require $view;
        } else {
            echo "<h1>Error $code</h1><p>" . htmlspecialchars($message !== '' ? $message : 'An error occurred.') . "</p>";
        }

        exit;
    }
}
