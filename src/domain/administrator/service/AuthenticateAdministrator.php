<?php

namespace coderaiz\domain\administrator\service;

use coderaiz\domain\auth\entity\Auth;
use coderaiz\domain\person\service\PersonServiceInterface;

class AuthenticateAdministrator
{
    private AdministratorServiceInterface $adminService;
    private PersonServiceInterface $personService;

    public function __construct(
        AdministratorServiceInterface $adminService,
        PersonServiceInterface $personService
    ) {
        $this->adminService = $adminService;
        $this->personService = $personService;
    }

    public function execute(Auth $auth): array
    {
        $person = $this->personService->searchEmail($auth->getEmail());

        if ($person === false) {
            throw new \Exception('E-mail não encontrado!', 1);
        }

        // Pesquisa se a pessoa é um administrador
        $admin = $this->adminService->searchPerson($person['person_id']);

        if ($admin === false) {
            throw new \Exception('Administrador inexistente!', 1);
        }

        $passwordIsValid = $auth->getPassword()->verify($person['password']);

        if ($passwordIsValid === false) {
            throw new \Exception('Senha inválida!', 1);
        }

        unset($person['password']);

        $data['administrator'] = $admin;

        return $data;
    }
}
