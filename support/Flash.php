<?php

declare(strict_types=1);

namespace Support;

class Flash {

    public static function set(string $key, mixed $value): void {
        Session::set("flash.$key", $value);
    }

    public static function get(string $key, mixed $default = null): mixed {
        return Session::get("flash.$key", $default);
    }

    public static function has(string $key): bool {
        return Session::has("flash.$key");
    }

    public static function clear(): void {
        Session::remove("flash");
    }
}
