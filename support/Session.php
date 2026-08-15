<?php

declare(strict_types=1);

namespace Support;

class Session {

    public static function set(string $key, mixed $value): void {
        $keys = explode('.', $key);
        $temp = &$_SESSION;

        foreach ($keys as $index => $segment) {
            if ($index === count($keys) - 1) {
                $temp[$segment] = $value;
                return;
            }

            if (!isset($temp[$segment]) || !is_array($temp[$segment])) {
                $temp[$segment] = [];
            }

            $temp = &$temp[$segment];
        }
    }

    public static function get(string $key, mixed $default = null): mixed {
        $keys = explode('.', $key);
        $temp = $_SESSION ?? [];

        foreach ($keys as $segment) {
            if (!isset($temp[$segment])) {
                return $default;
            }

            $temp = $temp[$segment];
        }

        return $temp;
    }

    public static function has(string $key): bool {
        return self::get($key) !== null;
    }

    public static function remove(string $key): void {
        $keys = explode('.', $key);
        $lastKey = array_pop($keys);
        $temp = &$_SESSION;

        foreach ($keys as $segment) {
            if (!isset($temp[$segment]) || !is_array($temp[$segment])) {
                return;
            }

            $temp = &$temp[$segment];
        }

        unset($temp[$lastKey]);
    }

    public static function destroy(): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public static function regenerateId(bool $deleteOldSession = true): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id($deleteOldSession);
        }
    }
}
