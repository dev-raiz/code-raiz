<?php

namespace coderaiz\app\purephp\http\controllers\api\employee;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\Pagination;
use coderaiz\domain\employee\service\EmployeeServiceInterface;

class EmployeeListController extends Controller
{
    #[Inject]
    private Pagination $pagination;

    #[Inject]
    private EmployeeServiceInterface $service;

    public function __construct() {}

    public function run(): void
    {
        try {

            if (isset(PARAMS['page']) === true && empty(PARAMS['page']) === false) {
                $this->pagination->setCurrentPage(intval(PARAMS['page']));
            }

            if (isset(PARAMS['records_per_page']) === true && empty(PARAMS['records_per_page']) === false) {
                $this->pagination->setNumberOfRecordsPerPage(intval(PARAMS['records_per_page']));
            }
            
            $data = $this->service->listAllWithPagination(COMPANY_ID, $this->pagination);

            $result = array(
                'result'  => 'success',
                'message' => 'Lista de funcionários.',
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
