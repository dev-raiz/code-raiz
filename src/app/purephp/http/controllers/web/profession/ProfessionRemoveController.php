<?php

namespace coderaiz\app\purephp\http\controllers\web\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\profession\service\ProfessionServiceInterface;
use coderaiz\domain\Delete;

class ProfessionRemoveController extends Controller
{
    #[Inject]
    private Delete $delete;

    #[Inject]
    private ProfessionServiceInterface $service;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {

            if (isset(URL_PARAMS[3]) === true || empty(URL_PARAMS[3]) === false) {
                $professionId = (int) $this->decrypt(URL_PARAMS[3]);

                $this->delete->setRecordId($professionId);
                $this->delete->setDeleted('Y');
                $this->delete->setDate(TODAY);
                $this->delete->setTime(NOW);
                $this->delete->setLevel(USER_LEVEL);
                $this->delete->setUserId(USER_ID);
    
                $this->service->remove($this->delete);
                
                $this->showToast([
                    'result'  => 'success',
                    'message' => 'Profissão excluída com sucesso!',
                ]);

                $this->redirect('profession/list');
            }

        } catch (\Exception $e) {
            $this->showToast([
                'result'  => 'warning',
                'message' => $e->getMessage()
            ]);

            $this->redirect('profession/list');
        }
    }
}
