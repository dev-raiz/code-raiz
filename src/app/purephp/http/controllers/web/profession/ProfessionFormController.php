<?php

namespace coderaiz\app\purephp\http\controllers\web\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\profession\service\ProfessionServiceInterface;

class ProfessionFormController extends Controller
{
    #[Inject]
    private ProfessionServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            $data['title']  = 'nova profissão';
            $data['action'] = 'add';

            if (isset(URL_PARAMS[3]) === true || empty(URL_PARAMS[3]) === false) {
                $data['title']  = 'editar profissão';
                $data['action'] = 'edit';

                $professionId   = (int) $this->decrypt(URL_PARAMS[3]);

                $data['profession_id'] = URL_PARAMS[3];
                $data['profession']    = $this->service->search($professionId);
            }

            if (isset($_COOKIE['profession']) === true) {
                $data['profession'] = json_decode($_COOKIE['profession'], true);
                $this->cookieDestroy('profession');
            }

            $this->render('/profession/form', $data);
        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $this->filterChars($e->getMessage()),
            ]);

            $this->redirect('profession/list');
        }
    }
}
