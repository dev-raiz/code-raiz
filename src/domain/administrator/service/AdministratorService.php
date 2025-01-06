<?php

namespace coderaiz\domain\administrator\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\administrator\entity\Administrator;
use coderaiz\domain\administrator\repository\AdministratorRepositoryInterface;

class AdministratorService implements AdministratorServiceInterface
{
    private AdministratorRepositoryInterface $repository;

    public function __construct(AdministratorRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function search(int $administratorId): array|bool
    {
        return $this->repository->findId($administratorId);
    }

    public function searchPerson(int $personId): array|bool
    {
        return $this->repository->findPersonId($personId);
    }

    public function listWithPagination(Pagination $pagination): array
    {
        $data['companies'] = [];
        $data['quantity']  = 0;

        $totalOfRecords = $this->repository->totalOfRecords();

        if ($totalOfRecords === 0) {
            return $data;
        }

        $pagination->paginate($totalOfRecords);

        $companies = $this->repository->fetchAllWithPagination($pagination);

        $data['companies'] = $companies;
        $data['quantity']  = count($companies);

        $data['pagination']['current-page']               = $pagination->getCurrentPage();
        $data['pagination']['number-of-records-per-page'] = $pagination->getNumberOfRecordsPerPage();
        $data['pagination']['number-of-pages']            = $pagination->getNumberOfPages();
        $data['pagination']['number-of-records']          = $totalOfRecords;

        return $data;
    }

    public function add(Administrator $administrator): int
    {
        return $this->repository->insert($administrator);
    }

    public function edit(Administrator $administrator): bool
    {
        return $this->repository->update($administrator);
    }
}
