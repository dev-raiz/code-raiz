<?php

use coderaiz\app\purephp\http\controllers\panel\company\CompanyAddController;
use coderaiz\app\purephp\http\controllers\panel\company\CompanyDetailsController;
use coderaiz\app\purephp\http\controllers\panel\company\CompanyEditController;
use coderaiz\app\purephp\http\controllers\panel\company\CompanyFormController;
use coderaiz\app\purephp\http\controllers\panel\company\CompanyListController;

return [
    'GET|list'     => [CompanyListController::class, 'private'],
    'GET|form'     => [CompanyFormController::class, 'private'],
    'POST|add'     => [CompanyAddController::class, 'private'],
    'POST|edit'    => [CompanyEditController::class, 'private'],
    'POST|details' => [CompanyDetailsController::class, 'private']
];
