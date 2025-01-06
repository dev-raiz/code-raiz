<?php

namespace coderaiz\app\purephp\http\controllers\web\auth;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\core\Jwt;
use coderaiz\app\purephp\http\data\AuthData;
use coderaiz\domain\user\service\AuthenticateUser;
use coderaiz\shared\GoogleRecaptcha;

class AuthController extends Controller
{
    #[Inject]
    private AuthData $authData;

    #[Inject]
    private AuthenticateUser $authUser;

    #[Inject]
    private Jwt $jwt;

    #[Inject]
    private GoogleRecaptcha $googleRecaptcha;

    public function run(): void
    {
        try {
            if (isset($_POST['access']) === true) {
                if (ENVIRONMENT === 'PROD') {
                    if ($this->googleRecaptcha->validate($_POST['g-recaptcha-response']) === false) {
                        throw new \Exception('Recaptcha inválido!', 2);
                    }
                }

                $auth   = $this->authData->getAuth($_POST);
                $result = $this->authUser->execute($auth);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Login efetuado com sucesso!',
                    'code'    => 0
                ]);

                $payload  = $result['user']['user_id'] . '|';     // ID usuário
                $payload .= $result['user']['company_id'] . '|';  // ID Empresa
                $payload .= $result['user']['social_name'] . '|'; // Nome usuário
                $payload .= 'user' . '|';                         // Nível
                $payload .= 'web';                                // Contexto

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
            }
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
