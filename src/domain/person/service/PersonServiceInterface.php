<?php

namespace coderaiz\domain\person\service;

use coderaiz\domain\person\entity\Person;
use coderaiz\domain\person\repository\PersonRepositoryInterface;

interface PersonServiceInterface
{
    public function __construct(PersonRepositoryInterface $repository);

    public function search(int $personId): array|bool;
    public function searchEmail(string $email): array|bool;
    public function add(Person $person): int;
    public function edit(Person $person): bool;
}
