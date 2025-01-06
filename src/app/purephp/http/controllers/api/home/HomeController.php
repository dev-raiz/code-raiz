<?php

namespace coderaiz\app\purephp\http\controllers\api\home;

use coderaiz\app\purephp\core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function run(): void
    {
        $this->send([
            'result' => 'success',
            'message' => 'Olá mundo!'
        ]);
    }
}
