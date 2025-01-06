<?php

namespace coderaiz\domain\profession\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\profession\entity\Profession;
use coderaiz\domain\profession\repository\ProfessionRepositoryInterface;

interface ProfessionServiceInterface
{
    public function __construct(ProfessionRepositoryInterface $repository);

    public function search(int $professionId): array|bool;
    public function listAllWithPagination(int $companyId, Pagination $pagination): array;
    public function add(Profession $profession): int;
    public function edit(Profession $profession): bool;
    public function remove(Delete $delete): bool;
}
