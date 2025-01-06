<?php

use coderaiz\app\purephp\http\controllers\api\employee\EmployeeAddController;
use coderaiz\app\purephp\http\controllers\api\employee\EmployeeEditController;
use coderaiz\app\purephp\http\controllers\api\employee\EmployeeListController;

return [
    'POST|add'   => [EmployeeAddController::class, 'private'],
    'POST|edit'  => [EmployeeEditController::class, 'private'],
    'GET|list'   => [EmployeeListController::class, 'private']
];
