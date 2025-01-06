<?php

namespace coderaiz\app\purephp\http\controllers\panel\company;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\service\CompanyServiceInterface;

class CompanyListController extends Controller
{
    #[Inject]
    private Pagination $pagination;

    #[Inject]
    private CompanyServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_COOKIE['ck-records-company-list'])) {
                $this->pagination->setNumberOfRecordsPerPage(intval($_COOKIE['ck-records-company-list']));
            }

            if (isset($_COOKIE['ck-page-company-list'])) {
                $this->pagination->setCurrentPage(intval($_COOKIE['ck-page-company-list']));
            }

            $data = $this->service->listWithPagination($this->pagination);
            $this->render('/company/list', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('company/list');
        }
    }
}
