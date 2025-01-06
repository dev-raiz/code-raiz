<?php

namespace coderaiz\app\purephp\http\controllers\api\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\EmployeeData;
use coderaiz\domain\employee\service\EmployeeServiceInterface;

class EmployeeEditController extends Controller
{
    #[Inject]
    private EmployeeData $data;

    #[Inject]
    private EmployeeServiceInterface $service;

    public function __construct() {}

    public function run(): void
    {
        try {
            $employee = $this->data->getEmployee(PARAMS);
            $this->service->edit($employee);

            $result = array(
                'result'  => 'success',
                'message' => 'Funcionário atualizado com sucesso!',
                'data'    =>  array()
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
