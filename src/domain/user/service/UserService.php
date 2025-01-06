<?php

namespace coderaiz\domain\user\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\person\service\PersonServiceInterface;
use coderaiz\domain\user\entity\User;
use coderaiz\domain\user\repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $repository;
    private PersonServiceInterface $personService;

    public function __construct(
        UserRepositoryInterface $repository,
        PersonServiceInterface $personService
    ) {
        $this->repository = $repository;
        $this->personService = $personService;
    }

    public function search(int $userId): array|bool
    {
        return $this->repository->findId($userId);
    }

    public function searchPerson(int $personId): array|bool
    {
         return $this->repository->findPersonId($personId);
    }

    public function listWithPagination(int $companyId, Pagination $pagination): array
    {
        $data['users']    = [];
        $data['quantity'] = 0;

        $totalOfRecords = $this->repository->totalOfRecords($companyId);

        if ($totalOfRecords === 0) {
            $data['message'] = 'Nenhum usuário encontrado!';
            return $data;
        }

        $pagination->paginate($totalOfRecords);

        $users = $this->repository->fetchAllWithPagination($companyId, $pagination);

        $data['users']    = $users;
        $data['quantity'] = count($users);

        $data['pagination']['current-page']               = $pagination->getCurrentPage();
        $data['pagination']['number-of-records-per-page'] = $pagination->getNumberOfRecordsPerPage();
        $data['pagination']['number-of-pages']            = $pagination->getNumberOfPages();
        $data['pagination']['number-of-records']          = $totalOfRecords;

        return $data;
    }

    public function add(User $user): int
    {
        $this->personService->add($user->getPerson());
        return $this->repository->insert($user);
    }

    public function edit(User $user): bool
    {
        $this->personService->edit($user->getPerson());
        return $this->repository->update($user);
    }
}
