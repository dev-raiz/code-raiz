<?php

namespace coderaiz\domain\company\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\entity\Company;
use coderaiz\domain\company\repository\CompanyRepositoryInterface;

class CompanyService implements CompanyServiceInterface
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function search(int $companyId): array|bool
    {
        return $this->repository->findId($companyId);
    }

    public function listWithPagination(Pagination $pagination): array
    {
        $data['companies'] = [];
        $data['quantity']  = 0;

        // $data['filter']['name'] = '';

        $totalOfRecords = $this->repository->totalOfRecords();

        if ($totalOfRecords === 0) {
            $data['message'] = 'Nenhuma empresa encontrada!';
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

    public function add(Company $company, GenerateCompanyToken $generateCompanyToken): int
    {
        $companyId = $this->repository->insert($company);

        $company->setId($companyId);
        $token = $generateCompanyToken->execute($company);

        $this->repository->updateToken($companyId, $token);

        return $companyId;
    }

    public function edit(Company $company): bool
    {
        return $this->repository->update($company);
    }
}
