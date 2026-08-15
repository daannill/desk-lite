<?php

declare(strict_types=1);

namespace Support;

class Auth {

    public static function info(string $key): mixed {
        return Session::get("auth.$key");
    }

    public static function auth(): bool {
        return Session::has('auth');
    }

    public static function role(): ?string {
        return Session::get('auth.role');
    }

    public static function guest(): bool {
        return !self::auth();
    }
}
