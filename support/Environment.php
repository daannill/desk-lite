<?php

declare(strict_types=1);

namespace Support;

class Environment {

    public static function get(string $key, mixed $default = null): mixed {
        return $_ENV[$key] ?? $_SERVER[$key] ?? (getenv($key) !== false ? getenv($key) : $default);
    }

    public static function isDev(): bool {
        $env = strtolower((string) self::get('APP_ENV', 'production'));
        return in_array($env, ['dev', 'development', 'local'], true);
    }

    public static function isProduction(): bool {
        return !self::isDev();
    }
}
