<?php

declare(strict_types=1);

require_once APP_PATH . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Core\App;

$dotenv = Dotenv::createImmutable(APP_PATH);
$dotenv->load();

require_once APP_PATH . '/config.php';
require_once APP_PATH . '/core/helpers.php';

$app = new App();
