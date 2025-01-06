<?php

namespace coderaiz\app\purephp\http\controllers\web\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\employee\service\EmployeeServiceInterface;
use coderaiz\app\purephp\http\data\EmployeeData;

class EmployeeEditController extends Controller
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
                $this->service->edit($employee);
                
                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Informações atualizadas com sucesso!'
                ]);

                $this->redirect('employee/list');
            }
        } catch (\Exception $e) {
            $_POST['person_id']      = $this->decrypt($_POST['person_id']);
            $_POST['document']       = $_POST['cpf'];
            $_POST['date_of_birth']  = $this->maskDateDB($_POST['date_of_birth']);
            $_POST['profession_id']  = $this->decrypt($_POST['profession']);
            $_POST['price_per_hour'] = $this->filterDecimal($_POST['price_per_hour']);

            $this->cookieDefine([
                'name' => 'employee',
                'value' => json_encode($_POST)
            ]);

            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage()
            ]);

            $this->redirect('employee/form/' . $_POST['employee_id']);
        }
    }
}
