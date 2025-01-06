<?php

namespace coderaiz\app\purephp\http\controllers\api\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\ProfessionData;
use coderaiz\domain\profession\service\ProfessionServiceInterface;

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
            if (isset(PARAMS['profession_id']) === false) {
                throw new \Exception('O parâmetro ID da Profissão é obrigatório.', 400);
            }

            if (isset(PARAMS['description']) === false) {
                throw new \Exception('O parâmetro Descrição é obrigatório.', 400);
            }

            if (empty(PARAMS['profession_id']) === true) {
                throw new \Exception('O parâmetro ID da Profissão não pode ser vazio.', 422);
            }

            if (empty(PARAMS['description']) === true) {
                throw new \Exception('O parâmetro Descrição não pode ser vazio.', 422);
            }
            
            $profession = $this->data->getProfession(PARAMS);
            $this->service->edit($profession);

            $result = array(
                'result'  => 'success',
                'message' => 'Profissão atualizada com sucesso!'
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
