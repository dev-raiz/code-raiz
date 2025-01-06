<?php

namespace coderaiz\app\purephp\access;

class AppAccess extends Access
{
    public function execute(string $context): void
    {
        if (isset($_COOKIE['token']) === false || isset($_SESSION['token']) === false) {
            $this->cookieDefine(['name' => 'alert-warning', 'value' => 'Acesso negado!']);
            header('Location: /login');
            exit;
        }

        if ($_COOKIE['token'] !== $_SESSION['token']) {
            $this->cookieDefine(['name' => 'alert-warning', 'value' => 'Token inválido!']);
            header('Location: /login');
            exit;
        }

        if ($this->jwt->tokenIsValid($_COOKIE['token']) === false) {
            $this->cookieDefine(['name' => 'alert-warning', 'value' => 'Token inválido!']);
            header('Location: /login');
            exit;
        }

        $timeLimitSession = (intval($_SESSION['activity']) + 30 * 60);

        if (TIMESTAMP > $timeLimitSession) {
            $this->cookieDefine(['name' => 'alert-warning', 'value' => 'Token expirado!']);
            header('Location: /login');
            exit;
        }

        $_SESSION['activity'] = TIMESTAMP;

        $tokenParsed = $this->jwt->parse($_SESSION['token']);
        $vector = explode('|', $this->decrypt($tokenParsed['payload']['jti']));

        define('USER_ID',    intval($vector[0]));
        define('COMPANY_ID', intval($vector[1]));
        define('USER_NAME',  $vector[2]);
        define('USER_LEVEL', $vector[3]);
        define('CONTEXT',    $vector[4]);

        $company = $this->companyService->search(COMPANY_ID);

        define('COMPANY_DATA',$company);
    }
}
