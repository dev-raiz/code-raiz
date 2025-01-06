<?php

namespace coderaiz\app\purephp\http\controllers\panel\company;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\company\service\CompanyServiceInterface;

class CompanyFormController extends Controller
{
    #[Inject]
    private CompanyServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            $data['title']  = 'nova empresa';
            $data['action'] = 'add';

            if (isset(URL_PARAMS[3]) === true || empty(URL_PARAMS[3]) === false) {
                $data['title']  = 'editar empresa';
                $data['action'] = 'edit';

                $companyId   = (int) $this->decrypt(URL_PARAMS[3]);

                $data['company_id'] = URL_PARAMS[3];
                $data['company']    = $this->service->search($companyId);
            }

            if (isset($_COOKIE['company']) === true) {
                $data['company'] = json_decode($_COOKIE['company'], true);
                $this->cookieDestroy('company');
            }

            $this->render('/company/form', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('company/list');
        }
    }
}
