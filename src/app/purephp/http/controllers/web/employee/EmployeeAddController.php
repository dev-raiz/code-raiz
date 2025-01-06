<?php

namespace coderaiz\app\purephp\http\controllers\web\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\EmployeeData;
use coderaiz\domain\employee\service\EmployeeServiceInterface;

class EmployeeAddController extends Controller
{
    #[Inject]
    private EmployeeData $data;

    #[Inject]
    private EmployeeServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_POST['save']) === true) {
                $employee = $this->data->getEmployee($_POST);
                $this->service->add($employee);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Funcionário inserido com sucesso!',
                ]);

                $this->redirect('employee/list');
            }
        } catch (\Exception $e) {
            $_POST['document']       = $_POST['cpf'];
            $_POST['profession_id']  = $_POST['profession'];
            $_POST['price_per_hour'] = $this->filterDecimal($_POST['price_per_hour']);

            $this->cookieDefine([
                'name' => 'employee',
                'value' => json_encode($_POST)
            ]);

            $this->showToast([
                'result'  => 'warning',
                'message' => $this->filterChars($e->getMessage())
            ]);

            $this->redirect('employee/form');
        }
    }
}
