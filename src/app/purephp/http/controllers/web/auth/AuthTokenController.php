<?php

namespace coderaiz\app\purephp\http\controllers\web\auth;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\core\Jwt;
use coderaiz\domain\administrator\service\AdministratorServiceInterface;

class AuthTokenController extends Controller
{
    #[Inject]
    private AdministratorServiceInterface $adminService;

    #[Inject]
    private Jwt $jwt;

    public function run(): void
    {
        try {
            if (isset(URL_PARAMS[3]) === false || empty(URL_PARAMS[3]) === true) {
                throw new \Exception('Acesso negado!');
            }

            $decryptedToken = $this->decrypt(URL_PARAMS[3]);

            if (empty($decryptedToken) === true) {
                throw new \Exception('Acesso negado!');
            }

            $vector = explode('|', $decryptedToken);
            $key = end($vector);

            $payload = $vector[0]  . '|'; // ID do admin
            $payload .= 'MASTER'   . '|'; // Literal fixo
            $payload .= $vector[2] . '|'; // ID da empresa
            $payload .= TODAY . '|';      // Data atual

            if (
                $vector[1] !== 'MASTER' ||
                $vector[3] !== TODAY ||
                $this->encrypt($payload) !== $key
            ) {
                throw new \Exception('Token inválido!');
            }

            $admin = $this->adminService->search($vector[0]);

            if ($admin === false) {
                throw new \Exception('Administrador não encontrado!');
            }

            session_destroy();
            array_walk($_COOKIE, function ($item, $key) {
                $this->cookieDestroy($key);
            });
            session_start();

            $this->showToast([
                'result'  => 'success',
                'message' => 'Acesso MASTER efetuado com sucesso!',
                'code'    => 0
            ]);

            $payload  = $vector[0] . '|';            // ID admin
            $payload .= $vector[2] . '|';            // ID Empresa
            $payload .= $admin['social_name'] . '|'; // Nome admin
            $payload .= 'master' . '|';              // Nível
            $payload .= 'web';                       // Contexto

            $payload  = $this->encrypt($payload);

            $this->jwt->addPayload('jti', $payload);
            $token = $this->jwt->token();

            $secure = false;
            if (ENVIRONMENT === 'PROD') {
                $secure = true;
            }

            $this->cookieDefine([
                'name'      => 'token',
                'value'     => $token,
                'secure'    => $secure,
                'http_only' => true
            ]);

            $_SESSION['token']    = $token;
            $_SESSION['activity'] = TIMESTAMP;

            $this->redirect('home');
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('login');
        }
    }
}
