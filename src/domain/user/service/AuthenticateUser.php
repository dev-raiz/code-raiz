<?php

namespace coderaiz\domain\user\service;

use coderaiz\domain\auth\entity\Auth;
use coderaiz\domain\person\service\PersonServiceInterface;

class AuthenticateUser
{
    private UserServiceInterface $userService;
    private PersonServiceInterface $personService;

    public function __construct(
        UserServiceInterface $userService,
        PersonServiceInterface $personService
    ) {
        $this->userService = $userService;
        $this->personService = $personService;
    }

    public function execute(Auth $auth): array
    {
        $person = $this->personService->searchEmail($auth->getEmail());

        if ($person === false) {
            throw new \Exception('E-mail não encontrado!', 1);
        }

        // Pesquisa se a pessoa é um usuário
        $user = $this->userService->searchPerson($person['person_id']);

        if ($user === false) {
            throw new \Exception('Usuário inexistente!', 1);
        }

        $passwordIsValid = $auth->getPassword()->verify($person['password']);

        if ($passwordIsValid === false) {
            throw new \Exception('Senha inválida!', 1);
        }

        unset($person['password']);

        $data['user'] = $user;

        return $data;
    }
}
