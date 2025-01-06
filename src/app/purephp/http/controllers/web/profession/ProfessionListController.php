<?php

namespace coderaiz\app\purephp\http\controllers\web\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\Pagination;
use coderaiz\domain\profession\service\ProfessionServiceInterface;

class ProfessionListController extends Controller
{
    #[Inject]
    private Pagination $pagination;

    #[Inject]
    private ProfessionServiceInterface $professionService;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset($_COOKIE['ck-records-profession-list'])) {
                $this->pagination->setNumberOfRecordsPerPage(intval($_COOKIE['ck-records-profession-list']));
            }

            if (isset($_COOKIE['ck-page-profession-list'])) {
                $this->pagination->setCurrentPage(intval($_COOKIE['ck-page-profession-list']));
            }

            $data = $this->professionService->listAllWithPagination(COMPANY_ID, $this->pagination);
            $this->render('/profession/list', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
            ]);

            $this->redirect('profession/list');
        }
    }
}
