<?php

namespace coderaiz\domain\user\repository;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\user\entity\User;
use coderaiz\infra\repositories\DatabaseInterface;

interface UserRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $userId): bool|array;
    public function findPersonId(int $personId): bool|array;
    public function totalOfRecords(int $companyId): int;
    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array;
    public function insert(User $user): int;
    public function update(User $user): bool;
    
}