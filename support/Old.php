<?php

declare(strict_types=1);

namespace Support;

use Core\Request;

class Old {

    public static function set(): void {
        Session::set('old', Request::post());
    }

    public static function get(string $key, mixed $default = null): mixed {
        return Session::get("old.$key", $default);
    }

    public static function clear(): void {
        Session::remove('old');
    }
}
