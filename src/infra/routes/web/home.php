<?php

use coderaiz\app\purephp\http\controllers\web\home\HomeController;

return [
    'GET|home' => [HomeController::class, 'private'],
];
