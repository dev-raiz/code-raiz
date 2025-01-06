<?php

use coderaiz\app\purephp\http\controllers\panel\home\HomeController;

return [
    'GET|home' => [HomeController::class, 'private'],
];
