<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Core\App;
use Support\ErrorHandler;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/core/helpers.php';

ErrorHandler::register();

$app = new App();
