<?php

namespace coderaiz\domain\administrator\repository;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\administrator\entity\Administrator;
use coderaiz\infra\repositories\DatabaseInterface;

interface AdministratorRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $administratorId): bool|array;
    public function findPersonId(int $personId): bool|array;
    public function totalOfRecords(): int;
    public function fetchAllWithPagination(Pagination $pagination): array;
    public function insert(Administrator $administrator): int;
    public function update(Administrator $administrator): bool;    
}