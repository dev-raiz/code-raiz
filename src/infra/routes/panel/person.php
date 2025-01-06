<?php

use coderaiz\app\purephp\http\controllers\panel\person\PersonGenerateNewPasswordController;

return [
    'POST|generate-new-password' => [PersonGenerateNewPasswordController::class, 'private'],
];
