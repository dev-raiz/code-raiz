<?php

namespace coderaiz\app\purephp\http\controllers\panel\login;

use coderaiz\app\purephp\core\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function run(): void
    {
        $data = [];

        if (isset($_COOKIE['alert-error'])) {
            $data['alert']         = true;
            $data['alert-title']   = 'Erro!';
            $data['alert-type']    = 'error';
            $data['alert-message'] = $_COOKIE['alert-error'];
            $this->cookieDestroy('alert-error', '/');
        }

        if (isset($_COOKIE['alert-warning'])) {
            $data['alert']         = true;
            $data['alert-title']   = 'Aviso!';
            $data['alert-type']    = 'warning';
            $data['alert-message'] = $_COOKIE['alert-warning'];
            $this->cookieDestroy('alert-warning', '/');
        }

        if (isset($_COOKIE['alert-success'])) {
            $data['alert']         = true;
            $data['alert-title']   = 'Sucesso!';
            $data['alert-type']    = 'success';
            $data['alert-message'] = $_COOKIE['alert-success'];
            $this->cookieDestroy('alert-success', '/');
        }

        if (isset($_COOKIE['post']) === true) {
            $data['post'] = json_decode($_COOKIE['post']);
            $this->cookieDestroy('post');
        }

        require '../src/infra/views/panel/login/login.php';
    }
}
