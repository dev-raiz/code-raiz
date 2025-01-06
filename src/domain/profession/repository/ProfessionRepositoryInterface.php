<?php

namespace coderaiz\domain\profession\repository;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\profession\entity\Profession;
use coderaiz\infra\repositories\DatabaseInterface;

interface ProfessionRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $professionId): bool|array;
    public function totalOfRecords(int $companyId): int;
    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array;
    public function fetchAll(int $companyId): array;
    public function insert(Profession $profession): int;
    public function update(Profession $profession): bool;
    public function delete(Delete $delete): bool;
}