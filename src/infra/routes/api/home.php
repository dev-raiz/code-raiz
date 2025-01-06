<?php

use coderaiz\app\purephp\http\controllers\api\home\HomeController;

return [
    'POST|home' => [HomeController::class, 'private'],
];
