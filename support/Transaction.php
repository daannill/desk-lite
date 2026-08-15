<?php

declare(strict_types=1);

namespace Support;

use Core\Database;
use Throwable;

class Transaction {

    public static function run(callable $callback): bool {
        $db = Database::getInstance();

        try {
            $db->beginTransaction();

            $callback();

            $db->commit();

            return true;
        } catch (Throwable $e) {
            $db->rollBack();

            return false;
        }
    }
}
