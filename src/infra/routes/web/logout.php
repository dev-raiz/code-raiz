<?php

use coderaiz\app\purephp\http\controllers\web\logout\LogoutController;

return [
    'GET|logout' => [LogoutController::class, 'private'],
];
