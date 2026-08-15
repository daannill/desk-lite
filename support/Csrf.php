<?php

declare(strict_types=1);

namespace Support;

class Csrf {

    public static function token(): string {
        if (!Session::has('_token')) {
            Session::set('_token', bin2hex(random_bytes(32)));
        }

        return (string) Session::get('_token');
    }

    public static function field(): string {
        $token = self::token();
        return '<input type="hidden" name="_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function validate(string $token): bool {
        return Session::has('_token') && hash_equals((string) Session::get('_token'), $token);
    }
}
