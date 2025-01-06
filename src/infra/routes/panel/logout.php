<?php

use coderaiz\app\purephp\http\controllers\panel\logout\LogoutController;

return [
    'GET|logout' => [LogoutController::class, 'private'],
];
