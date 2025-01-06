<?php

namespace coderaiz\app\purephp\http\controllers\web\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\employee\service\EmployeeServiceInterface;
use coderaiz\domain\profession\service\ListOfAllProfessions;

class EmployeeFormController extends Controller
{
    #[Inject]
    private EmployeeServiceInterface $service;

    #[Inject]
    private ListOfAllProfessions $listProfessions;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            $data['title']  = 'novo funcionário';
            $data['action'] = 'add';

            if (isset(URL_PARAMS[3]) === true || empty(URL_PARAMS[3]) === false) {
                $data['title']  = 'editar funcionário';
                $data['action'] = 'edit';

                $employeeId   = (int) $this->decrypt(URL_PARAMS[3]);

                $data['employee_id'] = URL_PARAMS[3];
                $data['employee']    = $this->service->search($employeeId);
            }

            if (isset($_COOKIE['employee']) === true) {
                $data['employee'] = json_decode($_COOKIE['employee'], true);
                $this->cookieDestroy('employee');
            }

            $data['professions'] = $this->listProfessions->execute(COMPANY_ID);

            $this->render('/employee/form', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $this->filterChars($e->getMessage()),
            ]);

            $this->redirect('employee/list');
        }
    }
}
