<?php

namespace coderaiz\app\purephp\http\controllers\api\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\Delete;
use coderaiz\domain\profession\service\ProfessionServiceInterface;

class ProfessionRemoveController extends Controller
{
    #[Inject]
    private Delete $delete;

    #[Inject]
    private ProfessionServiceInterface $service;

    public function __construct() {}

    public function run(): void
    {
        try {
            if (isset(PARAMS['id']) === false) {
                throw new \Exception('O parâmetro ID é obrigatório.', 400);
            }

            if (empty(PARAMS['id']) === true) {
                throw new \Exception('O parâmetro ID não pode ser vazio.', 422);
            }

            $professionId = (int) PARAMS['id'];

            $this->delete->setRecordId($professionId);
            $this->delete->setDeleted('Y');
            $this->delete->setDate(TODAY);
            $this->delete->setTime(NOW);
            $this->delete->setLevel(USER_LEVEL);
            $this->delete->setUserId(USER_ID);

            $this->service->remove($this->delete);

            $result = array(
                'result'  => 'success',
                'message' => 'Profissão excluída com sucesso!'
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
