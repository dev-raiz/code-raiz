<?php

namespace coderaiz\app\purephp\http\controllers\panel\user;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\UserData;
use coderaiz\domain\user\service\UserServiceInterface;

class UserAddController extends Controller
{
    #[Inject]
    private UserData $data;

    #[Inject]
    private UserServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_POST['save']) === true) {
                $user = $this->data->getUser($_POST);
                $this->service->add($user);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Usuário inserido com sucesso!',
                    'code'    => 0
                ]);

                $this->redirect('user/list/' . $_POST['company_id']);
            }
        } catch (\Exception $e) {
            $_POST['document'] = $_POST['cpf'];
            
            $this->cookieDefine([
                'name' => 'user',
                'value' => json_encode($_POST)
            ]);

            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('user/form/' . $_POST['company_id']);
        }
    }
}
