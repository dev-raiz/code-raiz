<?php

namespace coderaiz\domain\profession\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\profession\entity\Profession;
use coderaiz\domain\profession\repository\ProfessionRepositoryInterface;

class ProfessionService implements ProfessionServiceInterface
{
    private ProfessionRepositoryInterface $repository;

    public function __construct(ProfessionRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function search(int $professionId): array|bool
    {
        return $this->repository->findId($professionId);
    }

    public function listAllWithPagination(int $companyId, Pagination $pagination): array
    {
        $data['professions'] = [];
        $data['quantity']  = 0;

        $totalOfRecords = $this->repository->totalOfRecords($companyId);

        if ($totalOfRecords === 0) {
            $data['message'] = 'Nenhuma profissão encontrada!';
            return $data;
        }

        $pagination->paginate($totalOfRecords);

        $professions = $this->repository->fetchAllWithPagination($companyId, $pagination);

        $data['professions'] = $professions;
        $data['quantity']  = count($professions);

        $data['pagination']['current-page']               = $pagination->getCurrentPage();
        $data['pagination']['number-of-records-per-page'] = $pagination->getNumberOfRecordsPerPage();
        $data['pagination']['number-of-pages']            = $pagination->getNumberOfPages();
        $data['pagination']['number-of-records']          = $totalOfRecords;

        return $data;
    }

    public function add(Profession $profession): int
    {
        return $this->repository->insert($profession);
    }

    public function edit(Profession $profession): bool
    {
        return $this->repository->update($profession);
    }

    public function remove(Delete $delete): bool
    {
        return $this->repository->delete($delete);
    }
}
