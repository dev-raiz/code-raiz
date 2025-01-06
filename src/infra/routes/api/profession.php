<?php

use coderaiz\app\purephp\http\controllers\api\profession\ProfessionAddController;
use coderaiz\app\purephp\http\controllers\api\profession\ProfessionEditController;
use coderaiz\app\purephp\http\controllers\api\profession\ProfessionListController;
use coderaiz\app\purephp\http\controllers\api\profession\ProfessionRemoveController;

return [
    'POST|add'   => [ProfessionAddController::class, 'private'],
    'POST|edit'  => [ProfessionEditController::class, 'private'],
    'GET|list'   => [ProfessionListController::class, 'private'],
    'GET|remove' => [ProfessionRemoveController::class, 'private'],
];
