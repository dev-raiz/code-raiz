<?php

namespace coderaiz\app\purephp\http\controllers\panel\logout;

use coderaiz\app\purephp\core\Controller;

class LogoutController extends Controller
{
    public function __construct()
    {
    }

    public function run(): void
    {
        session_destroy();
        array_walk($_COOKIE, function ($item, $key) {
            $this->cookieDestroy($key);
        });
        $this->redirect('login');
    }
}
