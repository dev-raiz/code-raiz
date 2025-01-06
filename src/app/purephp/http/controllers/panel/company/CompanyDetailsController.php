<?php

namespace coderaiz\app\purephp\http\controllers\panel\company;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\company\service\CompanyServiceInterface;

class CompanyDetailsController extends Controller
{
    #[Inject]
    private CompanyServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            $params = json_decode(file_get_contents('php://input'), true);

            if (isset($params['company_id']) === false) {
                throw new \Exception('Parâmetros inválidos!', 400);
            }

            if (empty($params['company_id']) === true) {
                throw new \Exception('O ID da empresa não pode ser vazio!', 422);
            }

            $companyId = (int) $this->decrypt($params['company_id']);

            $response['result']  = 'success';
            $response['message'] = 'Detalhes da empresa.';

            $response['data']['company'] = $this->service->search($companyId);

            $this->send($response);            
        } catch (\Exception $e) {
            $this->send([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);
        }
    }
}
