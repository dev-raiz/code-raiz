<?php

namespace coderaiz\app\purephp\http\controllers\panel\person;

use devraiz\StringTrait;
use DI\Attribute\Inject;
use coderaiz\app\purephp\core\Controller;
use coderaiz\domain\Email;
use coderaiz\domain\Password;
use coderaiz\domain\person\entity\Person;
use coderaiz\domain\person\service\GenerateNewPassword;

class PersonGenerateNewPasswordController extends Controller
{
    use StringTrait;

    #[Inject]
    private Person $person;

    #[Inject]
    private Email $email;

    #[Inject]
    private Password $password;

    #[Inject]
    private GenerateNewPassword $generateNewPasswordService;

    public function __construct()
    {
    }

    public function run(): void
    {
        try {
            $params = json_decode(file_get_contents('php://input'), true);

            if (isset($params['person_id']) === false) {
                throw new \Exception('Parâmetros inválidos!', 1);
            }

            $personId = (int) $this->decrypt($params['person_id']);

            if ($personId === 0) {
                throw new \Exception('Usuário inválido!', 1);
            }

            $this->person->setId($personId);
            $this->person->setEmail($this->email);

            $this->password->setPassword($this->generateString(12));
            $this->person->setPassword($this->password);

            $this->generateNewPasswordService->execute($this->person);

            $this->send([
                'result'  => 'success',
                'message' => 'Nova senha gerada com sucesso!'
            ]);
        } catch (\Exception $e) {
            $this->send([
                'result'  => 'warning',
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);
        }
    }
}
