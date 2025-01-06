<?php

namespace coderaiz\domain\employee\repository;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\employee\entity\Employee;
use coderaiz\infra\repositories\DatabaseInterface;

interface EmployeeRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $employeeId): bool|array;
    public function totalOfRecords(int $companyId): int;
    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array;
    public function insert(Employee $employee): int;
    public function update(Employee $employee): bool;
    public function delete(Delete $delete): bool;
}