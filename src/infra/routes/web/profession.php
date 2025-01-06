<?php

use coderaiz\app\purephp\http\controllers\web\profession\ProfessionAddController;
use coderaiz\app\purephp\http\controllers\web\profession\ProfessionEditController;
use coderaiz\app\purephp\http\controllers\web\profession\ProfessionFormController;
use coderaiz\app\purephp\http\controllers\web\profession\ProfessionListController;
use coderaiz\app\purephp\http\controllers\web\profession\ProfessionRemoveController;

return [
    'GET|list'   => [ProfessionListController::class, 'private'],
    'GET|form'   => [ProfessionFormController::class, 'private'],
    'POST|add'   => [ProfessionAddController::class, 'private'],
    'POST|edit'  => [ProfessionEditController::class, 'private'],
    'GET|remove' => [ProfessionRemoveController::class, 'private']
];
