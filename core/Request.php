<?php

declare(strict_types=1);

namespace Core;

class Request {

    public static function post(?string $key = null, mixed $default = null): mixed {
        if ($key === null) {
            return $_POST;
        }

        return $_POST[$key] ?? $default;
    }

    public static function get(?string $key = null, mixed $default = null): mixed {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key] ?? $default;
    }

    public static function file(?string $key = null, mixed $default = null): mixed {
        if ($key === null) {
            return $_FILES;
        }

        return $_FILES[$key] ?? $default;
    }

    public static function hasFile(string $key): bool {
        if (!isset($_FILES[$key])) {
            return false;
        }

        return $_FILES[$key]['error'] !== UPLOAD_ERR_NO_FILE;
    }

    public static function hasPost(string $key): bool {
        return isset($_POST[$key]);
    }

    public static function hasGet(string $key): bool {
        return isset($_GET[$key]);
    }

    public static function method(): string {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public static function isPost(): bool {
        return self::method() === 'POST';
    }

    public static function isGet(): bool {
        return self::method() === 'GET';
    }   
}