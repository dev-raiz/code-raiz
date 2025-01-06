<?php

namespace coderaiz\domain\profession\service;

use coderaiz\domain\profession\repository\ProfessionRepositoryInterface;

class ListOfAllProfessions
{
    private ProfessionRepositoryInterface $repository;

    public function __construct(ProfessionRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(int $companyId): array
    {
        return $this->repository->fetchAll($companyId);
    }

}
