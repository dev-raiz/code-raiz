<?php

namespace coderaiz\infra\repositories;

interface DatabaseInterface
{
    public function getInstance(): mixed;
    public function lastIdInserted(): int;
    public function startTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
    public function setExecutedMethod(string $executedMethod): void;
    public function instanceException(): void;
    public function executionException(bool $execute, mixed $stmt): void;
}