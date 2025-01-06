<?php

namespace coderaiz\app\purephp\http\controllers\web\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\Pagination;
use coderaiz\domain\employee\service\EmployeeServiceInterface;

class EmployeeListController extends Controller
{
    #[Inject]
    private Pagination $pagination;

    #[Inject]
    private EmployeeServiceInterface $employeeService;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_COOKIE['ck-records-employee-list'])) {
                $this->pagination->setNumberOfRecordsPerPage(intval($_COOKIE['ck-records-employee-list']));
            }

            if (isset($_COOKIE['ck-page-employee-list'])) {
                $this->pagination->setCurrentPage(intval($_COOKIE['ck-page-employee-list']));
            }

            $data = $this->employeeService->listAllWithPagination(COMPANY_ID, $this->pagination);
            $this->render('/employee/list', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
            ]);

            $this->redirect('employee/list');
        }
    }
}
