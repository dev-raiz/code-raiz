<?php

namespace coderaiz\domain\company\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\entity\Company;
use coderaiz\domain\company\repository\CompanyRepositoryInterface;

interface CompanyServiceInterface
{
    public function __construct(CompanyRepositoryInterface $repository);

    public function search(int $companyId): array|bool;
    public function listWithPagination(Pagination $pagination): array;
    public function add(Company $company, GenerateCompanyToken $generateCompanyToken): int;
    public function edit(Company $company): bool;
}
