<?php

namespace coderaiz\domain\employee\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\employee\entity\Employee;
use coderaiz\domain\employee\repository\EmployeeRepositoryInterface;
use coderaiz\domain\person\service\PersonServiceInterface;

class EmployeeService implements EmployeeServiceInterface
{
    private EmployeeRepositoryInterface $repository;
    private PersonServiceInterface $personService;

    public function __construct(
        EmployeeRepositoryInterface $repository,
        PersonServiceInterface $personService
    ) {
        $this->repository = $repository;
        $this->personService = $personService;
    }

    public function search(int $employeeId): array|bool
    {
        return $this->repository->findId($employeeId);
    }

    public function listAllWithPagination(int $companyId, Pagination $pagination): array
    {
        $data['employees'] = [];
        $data['quantity']  = 0;

        $totalOfRecords = $this->repository->totalOfRecords($companyId);

        if ($totalOfRecords === 0) {
            $data['message'] = 'Nenhum funcionário encontrado!';
            return $data;
        }

        $pagination->paginate($totalOfRecords);

        $employees = $this->repository->fetchAllWithPagination($companyId, $pagination);

        $data['employees'] = $employees;
        $data['quantity']  = count($employees);

        $data['pagination']['current-page']               = $pagination->getCurrentPage();
        $data['pagination']['number-of-records-per-page'] = $pagination->getNumberOfRecordsPerPage();
        $data['pagination']['number-of-pages']            = $pagination->getNumberOfPages();
        $data['pagination']['number-of-records']          = $totalOfRecords;

        return $data;
    }

    public function add(Employee $employee): int
    {
        $this->personService->add($employee->getPerson());
        return $this->repository->insert($employee);
    }

    public function edit(Employee $employee): bool
    {
        $this->personService->edit($employee->getPerson());
        return $this->repository->update($employee);
    }

    public function remove(Delete $delete): bool
    {
        return $this->repository->delete($delete);
    }
}
