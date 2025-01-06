<?php

namespace coderaiz\app\purephp\http\controllers\panel\company;

use devraiz\SecurityTrait;
use devraiz\StringTrait;
use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\BankAccountData;
use coderaiz\app\purephp\http\data\CompanyData;
use coderaiz\app\purephp\http\data\ConsumerData;
use coderaiz\domain\bank_account\service\BankAccountServiceInterface;
use coderaiz\domain\company\service\CompanyServiceInterface;
use coderaiz\domain\company\service\GenerateCompanyToken;
use coderaiz\domain\consumer\service\ConsumerServiceInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class CompanyAddController extends Controller
{
    use SecurityTrait;
    use StringTrait;

    #[Inject]
    private CompanyData $data;

    #[Inject]
    private CompanyServiceInterface $service;

    #[Inject]
    private GenerateCompanyToken $generateCompanyToken;

    #[Inject]
    private DatabaseInterface $db;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_POST['save']) === true) {
                $this->db->startTransaction();

                $company   = $this->data->getCompany($_POST);
                $this->service->add($company, $this->generateCompanyToken);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Empresa inserida com sucesso!',
                    'code'    => 0
                ]);

                $this->db->commit();

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

            $this->db->rollback();

            $this->redirect('company/form');
        }
    }
}
