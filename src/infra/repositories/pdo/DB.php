<?php

namespace coderaiz\infra\repositories\pdo;

use coderaiz\infra\repositories\DatabaseInterface;

class DB implements DatabaseInterface
{
    private ?\PDO $instance;
    private string $executedMethod = '';

    public function __construct(string $host = DB_HOST, string $user = DB_USERNAME, string $password = DB_PASSWORD, string $database = DB_DATABASE)
    {
        $this->instance = ConnectionPDO::getInstance($host, $user, $password, $database);
    }

    public function getInstance(string $debug = 'N'): ?\PDO
    {
        if ($debug === 'Y') {
            $this->instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->instance;
    }

    public function lastIdInserted(): int
    {
        if (!isset($this->instance)) {
            die('Erro MariaDB!');
        }

        return $this->instance->lastInsertId();
    }

    public function startTransaction(): void
    {
        $this->instance->beginTransaction();
    }

    public function commit(): void
    {
        $this->instance->commit();
    }

    public function rollback(): void
    {
        $this->instance->rollBack();
    }

    public function setExecutedMethod(string $executedMethod): void
    {
        $this->executedMethod = $executedMethod;
    }

    public function instanceException(): void
    {
        $exception = 'Statement: ';
        $exception .= $this->executedMethod;
        
        if (empty($this->getInstance()->errorInfo()[2]) === false) {
            $exception .= ': ' . $this->getInstance()->errorInfo()[2];
        }

        throw new \Exception($exception);
    }

    public function executionException(bool $execute, mixed $stmt): void
    {
        if ($execute === false) {
            $exception = 'Execução: ';
            $exception .= $this->executedMethod;

            if (empty($stmt->errorInfo()[2]) === false) {
                $exception .= ': ' . $stmt->errorInfo()[2];
            }

            throw new \Exception($exception);
        }
    }
}
