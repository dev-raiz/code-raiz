<?php

namespace coderaiz\app\purephp\http\controllers\web\home;

use coderaiz\app\purephp\core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function run(): void
    {
        $this->render('/home/home');
    }
}
