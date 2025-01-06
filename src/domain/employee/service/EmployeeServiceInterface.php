<?php

namespace coderaiz\domain\employee\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\employee\entity\Employee;
use coderaiz\domain\employee\repository\EmployeeRepositoryInterface;
use coderaiz\domain\person\service\PersonServiceInterface;

interface EmployeeServiceInterface
{
    public function __construct(
        EmployeeRepositoryInterface $repository,
        PersonServiceInterface $personService
    );

    public function search(int $employeeId): array|bool;
    public function listAllWithPagination(int $companyId, Pagination $pagination): array;
    public function add(Employee $employee): int;
    public function edit(Employee $employee): bool;
    public function remove(Delete $delete): bool;
}
