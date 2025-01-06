<?php

namespace coderaiz\app\purephp\http\controllers\api\employee;

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

    public function __construct() {}

    public function run(): void
    {
        try {
            $employee   = $this->data->getEmployee(PARAMS);
            $employeeId = $this->service->add($employee);

            $data = array('employee_id' => $employeeId);

            $result = array(
                'result'  => 'success',
                'message' => 'Funcionário adicionado com sucesso!',
                'data'    =>  $data
            );

            $this->send($result);
        } catch (\Exception $e) {
            $this->send(array(
                'result'  => 'warning',
                'message' => $e->getMessage()
            ), $e->getCode());
        }
    }
}
