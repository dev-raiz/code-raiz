<?php

namespace coderaiz\domain\person\service;

use coderaiz\domain\person\entity\Person;
use coderaiz\domain\person\repository\PersonRepositoryInterface;

class GenerateNewPassword
{
    private PersonRepositoryInterface $personRepo;
    private SendEmailOfNewGeneratedPassword $sendEmailOfNewGeneratedPassword;

    public function __construct(
        PersonRepositoryInterface $personRepo,
        SendEmailOfNewGeneratedPassword $sendEmailOfNewGeneratedPassword
    ) {
        $this->personRepo = $personRepo;
        $this->sendEmailOfNewGeneratedPassword = $sendEmailOfNewGeneratedPassword;
    }

    public function execute(Person $person): bool
    {
        if ($person->getId() === 0) {
            throw new \Exception('Pessoa inválida! O ID da pessoa não pode ser 0.', 1);
        }

        $dataPerson = $this->personRepo->findId($person->getId());

        if ($dataPerson === false) {
            throw new \Exception('Pessoa inválida! O ID da pessoa não foi encontrado.', 1);
        }

        $person->setSocialName($dataPerson['social_name']);
        $person->getEmail()->setEmail($dataPerson['email']);

        if ($person->getPassword() === '') {
            throw new \Exception('Senha inválida! A senha não pode ser vazia.', 1);            
        }

        $this->personRepo->updatePassword($person);

        $this->sendEmailOfNewGeneratedPassword->execute($person);

        return true;
    }
}
