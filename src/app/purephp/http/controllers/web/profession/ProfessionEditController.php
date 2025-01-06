<?php

namespace coderaiz\app\purephp\http\controllers\web\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\profession\service\ProfessionServiceInterface;
use coderaiz\app\purephp\http\data\ProfessionData;

class ProfessionEditController extends Controller
{
    #[Inject]
    private ProfessionData $data;

    #[Inject]
    private ProfessionServiceInterface $service;

    public function __construct() {}

    public function run(): void
    {
        try {
            if (isset($_POST['save']) === true) {
                $profession = $this->data->getProfession($_POST);
                $this->service->edit($profession);

                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Informações atualizadas com sucesso!'
                ]);

                $this->redirect('profession/list');
            }
        } catch (\Exception $e) {
            $this->cookieDefine([
                'name' => 'profession',
                'value' => json_encode($_POST)
            ]);

            $this->showToast([
                'result'  => 'warning',
                'message' => $this->filterChars($e->getMessage())
            ]);

            $this->redirect('profession/form');
        }
    }
}
