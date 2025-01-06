<?php

use coderaiz\app\purephp\http\controllers\panel\user\UserAddController;
use coderaiz\app\purephp\http\controllers\panel\user\UserEditController;
use coderaiz\app\purephp\http\controllers\panel\user\UserFormController;
use coderaiz\app\purephp\http\controllers\panel\user\UserListController;

return [
    'GET|list'  => [UserListController::class, 'private'],
    'GET|form'  => [UserFormController::class, 'private'],
    'POST|add'  => [UserAddController::class, 'private'],
    'POST|edit' => [UserEditController::class, 'private'],
];
