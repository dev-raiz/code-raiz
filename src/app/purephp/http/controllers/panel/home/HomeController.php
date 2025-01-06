<?php

namespace coderaiz\app\purephp\http\controllers\panel\home;

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
