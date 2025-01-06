<?php

namespace coderaiz\app\purephp\core;

use devraiz\CookieTrait;
use devraiz\FilterTrait;
use devraiz\LogTrait;
use devraiz\MaskTrait;
use devraiz\ResponseTrait;
use devraiz\ResultTrait;
use devraiz\SecurityTrait;
use devraiz\ToastTrait;

abstract class Controller
{
    use SecurityTrait;
    use CookieTrait;
    use ResultTrait;
    use ToastTrait;
    use LogTrait;
    use ResponseTrait;
    use MaskTrait;
    use FilterTrait;

    abstract protected function run(): void;

    public function render(string $view, array $data = []): void
    {
        if (isset($_COOKIE['alert-error'])) {
            $data['alert']                = true;
            $data['alert-title']          = 'Erro!';
            $data['alert-type']           = 'error';
            $data['alert-message']        = $_COOKIE['alert-error'];
            $data['alert-confirm-button'] = 'true';
            $this->cookieDestroy('alert-error', '/');
        }

        if (isset($_COOKIE['alert-warning'])) {
            $data['alert']                = true;
            $data['alert-title']          = 'Aviso!';
            $data['alert-type']           = 'warning';
            $data['alert-message']        = $_COOKIE['alert-warning'];
            $data['alert-confirm-button'] = 'true';
            $this->cookieDestroy('alert-warning', '/');
        }

        if (isset($_COOKIE['alert-success'])) {
            $data['alert']                = true;
            $data['alert-title']          = 'Sucesso!';
            $data['alert-type']           = 'success';
            $data['alert-message']        = $_COOKIE['alert-success'];
            $data['alert-confirm-button'] = 'false';
            $this->cookieDestroy('alert-success', '/');
        }

        $view  = Context::get() . $view;

        require '../src/infra/views/' . Context::get() . '/template.php';
    }

    public function redirect(string $view): void
    {
        header('Location: /' . $view);
        exit;
    }

    public function printOut(string $view, array $data = []): void
    {
        $view  = Context::get() . $view;
        
        require '../src/infra/views/' . $view . '.php';
    }
}
