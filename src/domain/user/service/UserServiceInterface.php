<?php

namespace coderaiz\domain\user\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\person\service\PersonServiceInterface;
use coderaiz\domain\user\entity\User;
use coderaiz\domain\user\repository\UserRepositoryInterface;

interface UserServiceInterface
{
    public function __construct(
        UserRepositoryInterface $repository,
        PersonServiceInterface $personService
    );

    public function search(int $userId): array|bool;
    public function searchPerson(int $personId): array|bool;
    public function listWithPagination(int $companyId, Pagination $pagination): array;
    public function add(User $user): int;
    public function edit(User $user): bool;
}
