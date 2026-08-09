<?php

use Core\Routes;

use App\Controllers\HomeController;

Routes::get('/', [HomeController::class, 'index']);