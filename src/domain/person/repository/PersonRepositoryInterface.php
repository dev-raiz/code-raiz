<?php

namespace coderaiz\domain\person\repository;

use coderaiz\domain\person\entity\Person;
use coderaiz\infra\repositories\DatabaseInterface;

interface PersonRepositoryInterface
{
    public function __construct(DatabaseInterface $db);

    public function findId(int $personId): bool|array;
    public function findDocument(string $document): bool|array;
    public function findDocumentOnAnotherId(int $personId, string $document): bool|array;
    public function findEmail(string $email): bool|array;
    public function findEmailOnAnotherId(int $personId, string $email): bool|array;
    public function insert(Person $person): int;
    public function update(Person $person): bool;
    public function updatePassword(Person $person): bool;
}