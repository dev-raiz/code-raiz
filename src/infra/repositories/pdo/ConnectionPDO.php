<?php

namespace coderaiz\infra\repositories\pdo;

class ConnectionPDO
{
    private static ?\PDO $instance = null;
    
    private function __construct() { }

    public static function getInstance(string $host, string $user, string $password, string $database)
    {
        if (is_null(self::$instance)) {
            $strConnection = 'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8mb4';
            self::$instance = new \PDO($strConnection, $user, $password);

            self::$instance->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERR_NONE);

            if (self::$instance->errorCode() !== '00000') {
                die('Erro MariaDB!');
            }
        }

        return self::$instance;
    }
}