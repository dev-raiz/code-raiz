<?php

use coderaiz\app\purephp\http\controllers\web\employee\EmployeeAddController;
use coderaiz\app\purephp\http\controllers\web\employee\EmployeeEditController;
use coderaiz\app\purephp\http\controllers\web\employee\EmployeeFormController;
use coderaiz\app\purephp\http\controllers\web\employee\EmployeeListController;

return [
    'GET|list'  => [EmployeeListController::class, 'private'],
    'GET|form'  => [EmployeeFormController::class, 'private'],
    'POST|add'  => [EmployeeAddController::class, 'private'],
    'POST|edit' => [EmployeeEditController::class, 'private'],
];
