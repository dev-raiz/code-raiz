<?php

namespace coderaiz\app\purephp\http\controllers\panel\user;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\service\CompanyServiceInterface;
use coderaiz\domain\user\service\UserServiceInterface;

class UserListController extends Controller
{
    #[Inject]
    private Pagination $pagination;

    #[Inject]
    private UserServiceInterface $userService;

    #[Inject]
    private CompanyServiceInterface $companyService;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            if (isset(URL_PARAMS[3]) === false || empty(URL_PARAMS[3]) === true) {
                throw new \Exception('Requisição inválida!');
            }

            if (isset($_COOKIE['ck-records-user-list'])) {
                $this->pagination->setNumberOfRecordsPerPage(intval($_COOKIE['ck-records-user-list']));
            }

            if (isset($_COOKIE['ck-page-user-list'])) {
                $this->pagination->setCurrentPage(intval($_COOKIE['ck-page-user-list']));
            }

            $companyId = (int) $this->decrypt(URL_PARAMS[3]);

            $data = $this->userService->listWithPagination($companyId, $this->pagination);
            $data['company_id'] = URL_PARAMS[3];
            $data['company']    = $this->companyService->search($companyId);

            $this->render('/user/list', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);

            $this->redirect('company/list/');
        }
    }
}
