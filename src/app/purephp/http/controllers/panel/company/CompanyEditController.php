<?php

namespace coderaiz\app\purephp\http\controllers\panel\company;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\company\service\CompanyServiceInterface;
use coderaiz\app\purephp\http\data\CompanyData;

class CompanyEditController extends Controller
{
    #[Inject]
    private CompanyData $data;

    #[Inject]
    private CompanyServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_POST['save']) === true) {
                $company = $this->data->getCompany($_POST);
                $this->service->edit($company);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Informações atualizadas com sucesso!',
                    'code'    => 0
                ]);

                $this->redirect('company/list');
            }
        } catch (\Exception $e) {
            $this->cookieDefine([
                'name' => 'company',
                'value' => json_encode($_POST)
            ]);

            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('company/form');
        }
    }
}
