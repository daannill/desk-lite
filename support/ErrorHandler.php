<?php

declare(strict_types=1);

namespace Support;

use Throwable;
use ErrorException;

class ErrorHandler {

    public static function register(): void {
        error_reporting(E_ALL);

        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleError(int $level, string $message, string $file = '', int $line = 0): bool {
        if (error_reporting() & $level) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
        return false;
    }

    public static function handleException(Throwable $e): void {
        self::logException($e);

        if (!headers_sent()) {
            http_response_code(500);
        }

        if (Environment::isDev()) {
            self::renderDevError($e);
        } else {
            self::renderProductionError();
        }

        exit;
    }

    public static function handleShutdown(): void {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            $exception = new ErrorException(
                $error['message'],
                0,
                $error['type'],
                $error['file'],
                $error['line']
            );
            self::handleException($exception);
        }
    }

    public static function logException(Throwable $e): void {
        $logDir = defined('APP_PATH') ? APP_PATH . '/storage/logs' : dirname(__DIR__) . '/storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . '/error.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = sprintf(
            "[%s] %s: %s in %s:%d\nStack trace:\n%s\n\n",
            $timestamp,
            get_class($e),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );

        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    private static function renderDevError(Throwable $e): void {
        $view = defined('APP_PATH') ? APP_PATH . '/support/views/errors/dev-500.php' : dirname(__DIR__) . '/support/views/errors/dev-500.php';
        if (file_exists($view)) {
            require $view;
        } else {
            echo "<h1>Development Error</h1>";
            echo "<p><strong>" . htmlspecialchars(get_class($e)) . ":</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p>In <code>" . htmlspecialchars($e->getFile()) . "</code> on line <strong>" . $e->getLine() . "</strong></p>";
            echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        }
    }

    private static function renderProductionError(): void {
        $view = defined('APP_PATH') ? APP_PATH . '/app/views/errors/500.php' : dirname(__DIR__) . '/app/views/errors/500.php';
        if (!file_exists($view)) {
            $view = defined('APP_PATH') ? APP_PATH . '/support/views/errors/500.php' : dirname(__DIR__) . '/support/views/errors/500.php';
        }

        if (file_exists($view)) {
            require $view;
        } else {
            echo "<h1>500 Server Error</h1><p>Terjadi kesalahan pada sistem. Silakan hubungi administrator.</p>";
        }
    }
}
