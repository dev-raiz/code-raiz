<?php

namespace coderaiz\domain\person\service;

use coderaiz\domain\person\entity\Person;
use coderaiz\domain\person\repository\PersonRepositoryInterface;

class PersonService implements PersonServiceInterface
{
    private PersonRepositoryInterface $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function search(int $personId): array|bool
    {
        return $this->repository->findId($personId);
    }

    public function searchEmail(string $email): array|bool
    {
        return $this->repository->findEmail($email);
    }

    public function add(Person $person): int
    {
        $doesThisDocumentExist = $this->repository->findDocument($person->getDocument());

        if ($doesThisDocumentExist !== false) {
            throw new \Exception('O CPF informado já está cadastrado para outro usuário! Verifique.', 1);
        }

        $doesThisEmailExist = $this->repository->findEmail($person->getEmail());

        if ($doesThisEmailExist !== false) {
            throw new \Exception('O E-mail informado já está cadastrado para outro usuário! Verifique.', 1);
        }

        $personId = $this->repository->insert($person);
        $person->setId($personId);

        return $personId;
    }

    public function edit(Person $person): bool
    {
        $doesThisDocumentExist = $this->repository->findDocumentOnAnotherId(
            $person->getId(),
            $person->getDocument()
        );

        if ($doesThisDocumentExist !== false) {
            throw new \Exception('O CPF informado já está cadastrado para outro usuário! Verifique.', 1);
        }

        $doesThisEmailExist = $this->repository->findEmailOnAnotherId(
            $person->getId(),
            $person->getEmail()
        );

        if ($doesThisEmailExist !== false) {
            throw new \Exception('O E-mail informado já está cadastrado para outro usuário! Verifique.', 1);
        }

        return $this->repository->update($person);
    }
}
