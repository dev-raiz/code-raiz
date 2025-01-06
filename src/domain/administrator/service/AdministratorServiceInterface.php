<?php

namespace coderaiz\domain\administrator\service;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\administrator\entity\Administrator;
use coderaiz\domain\administrator\repository\AdministratorRepositoryInterface;

interface AdministratorServiceInterface
{
    public function __construct(AdministratorRepositoryInterface $repository);

    public function search(int $administratorId): array|bool;
    public function searchPerson(int $personId): array|bool;
    public function listWithPagination(Pagination $pagination): array;
    public function add(Administrator $administrator): int;
    public function edit(Administrator $administrator): bool;
}
