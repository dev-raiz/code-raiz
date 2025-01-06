<?php

use coderaiz\app\purephp\http\controllers\web\auth\AuthController;
use coderaiz\app\purephp\http\controllers\web\auth\AuthTokenController;
use coderaiz\app\purephp\http\controllers\web\login\LoginController;

return [
    'GET|login'      => [LoginController::class, 'public'],
    'GET|auth-token' => [AuthTokenController::class, 'public'],
    'POST|auth'      => [AuthController::class, 'public'],
];
