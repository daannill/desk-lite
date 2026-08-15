<?php

declare(strict_types=1);

namespace Support;

class Str {

    public static function random(int $length = 6): string {
        return strtoupper(substr(bin2hex(random_bytes($length)), 0, $length));
    }

    public static function userId(): string {
        return 'USR' . self::random(6);
    }

    public static function courseId(): string {
        return 'CRS' . self::random(6);
    }

    public static function materialId(): string {
        return 'MAT' . self::random(6);
    }

    public static function enrollmentId(): string {
        return 'ENR' . self::random(6);
    }

    public static function attemptId(): string {
        return 'ATT' . self::random(6);
    }

    public static function ticketId(): string {
        return 'TCK-' . self::random(6);
    }
}
