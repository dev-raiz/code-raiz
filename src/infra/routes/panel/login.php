<?php

use coderaiz\app\purephp\http\controllers\panel\login\LoginController;
use coderaiz\app\purephp\http\controllers\panel\auth\AuthController;

return [
    'GET|login' => [LoginController::class, 'public'],
    'POST|auth' => [AuthController::class, 'public'],
];
