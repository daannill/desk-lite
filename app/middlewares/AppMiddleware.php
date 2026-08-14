<?php

namespace App\Middlewares;

use Core\Auth;
use Core\Redirect;
use Core\Abort;

class AppMiddleware {

    public static function guest(): void {
        if (Auth::auth()) {
            Redirect::to('/');
        }
    }

    public static function auth(): void {
        if (Auth::guest()) {
            Redirect::to('/login');
        }
    }

    public static function admin(): void {
        self::auth();

        if (Auth::role() !== 'admin') {
            Abort::error(403);
        }
    }

    public static function teacher(): void {
        self::auth();

        if (Auth::role() !== 'teacher') {
            Abort::error(403);
        }
    }
}
