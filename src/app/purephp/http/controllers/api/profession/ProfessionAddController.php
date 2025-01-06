<?php

namespace coderaiz\app\purephp\http\controllers\api\profession;

use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\app\purephp\http\data\ProfessionData;
use coderaiz\domain\profession\service\ProfessionServiceInterface;

class ProfessionAddController extends Controller
{
    #[Inject]
    private ProfessionData $data;

    #[Inject]
    private ProfessionServiceInterface $service;

    public function __construct() {}

    public function run(): void
    {
        try {
            if (isset(PARAMS['description']) === false) {
                throw new \Exception('O parâmetro Descrição é obrigatório.', 400);
            }

            if (empty(PARAMS['description']) === true) {
                throw new \Exception('O parâmetro Descrição não pode ser vazio.', 422);
            }

            $profession   = $this->data->getProfession(PARAMS);
            $professionId = $this->service->add($profession);

            $data = array('profession_id' => $professionId);

            $result = array(
                'result'  => 'success',
                'message' => 'Profissão adicionada com sucesso!',
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
