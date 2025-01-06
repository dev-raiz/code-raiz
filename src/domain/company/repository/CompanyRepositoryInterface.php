<?php

namespace coderaiz\domain\company\repository;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\entity\Company;
use coderaiz\infra\repositories\DatabaseInterface;

interface CompanyRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $companyId): bool|array;
    public function totalOfRecords(): int;
    public function fetchAllWithPagination(Pagination $pagination): array;
    public function insert(Company $company): int;
    public function update(Company $company): bool;
    public function updateToken(int $companyId, string $token): bool;
}