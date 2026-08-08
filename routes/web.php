<?php

use Core\Routes;

Routes::get('/', [HomeController::class, 'index']);