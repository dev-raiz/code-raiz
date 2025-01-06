<?php

namespace coderaiz\app\purephp\http\controllers\panel\user;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\company\service\CompanyServiceInterface;
use coderaiz\domain\user\service\UserServiceInterface;

class UserFormController extends Controller
{
    #[Inject]
    private UserServiceInterface $userService;

    #[Inject]
    private CompanyServiceInterface $companyService;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset(URL_PARAMS[3]) === false || empty(URL_PARAMS[3]) === true) {
                throw new \Exception('Empresa inválida!');
            }

            $data['title']  = 'novo usuário';
            $data['action'] = 'add';

            if (isset(URL_PARAMS[4]) === true || empty(URL_PARAMS[4]) === false) {
                $data['title']  = 'editar usuário';
                $data['action'] = 'edit';

                $userId   = (int) $this->decrypt(URL_PARAMS[4]);

                $data['user_id']   = URL_PARAMS[4];
                $data['user']      = $this->userService->search($userId);
                $data['person_id'] = $this->encrypt($data['user']['person_id']);
            }

            if (isset($_COOKIE['user']) === true) {
                $data['user'] = json_decode($_COOKIE['user'], true);
                $this->cookieDestroy('user');
            }

            $companyId = (int) $this->decrypt(URL_PARAMS[3]);
            $data['company_id'] = URL_PARAMS[3];
            $data['company']    = $this->companyService->search($companyId);

            $this->render('/user/form', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('user/list/' . URL_PARAMS[3]);
        }
    }
}
