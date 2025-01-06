<?php

namespace coderaiz\infra\repositories\pdo\profession;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\profession\entity\Profession;
use coderaiz\domain\profession\repository\ProfessionRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class ProfessionRepository implements ProfessionRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance('Y');
    }

    public function findId(int $professionId): bool|array
    {
        $this->db->setExecutedMethod('ProfessionRepository -> findId');

        $sql = "SELECT *
                FROM profession
                WHERE (profession_id = :profession_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':profession_id', $professionId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    public function totalOfRecords(int $companyId): int
    {
        $this->db->setExecutedMethod('ProfessionRepository -> totalOfRecords');

        $sql = "SELECT COUNT(profession_id) AS total
                FROM profession
                WHERE (company_id = :company_id)
                AND   (deleted    = :deleted);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);
        $stmt->bindValue(':deleted',    'N',                     \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array
    {
        $this->db->setExecutedMethod('ProfessionRepository -> fetchAllWithPagination');

        $sql = "SELECT profession_id,
                       company_id,
                       description,
                       registration_date,
                       registration_time
                FROM profession
                WHERE (company_id = :company_id)
                AND   (deleted    = :deleted)
                ORDER BY profession_id DESC
                LIMIT :start, :end;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId,              \PDO::PARAM_INT);
        $stmt->bindValue(':deleted',    'N',                     \PDO::PARAM_STR);
        $stmt->bindValue(':start',      $pagination->getStart(), \PDO::PARAM_INT);
        $stmt->bindValue(':end',        $pagination->getEnd(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchAll(int $companyId): array
    {
        $this->db->setExecutedMethod('ProfessionRepository -> fetchAll');

        $sql = "SELECT *
                FROM profession
                WHERE (company_id = :company_id)
                AND   (deleted    = :deleted)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);
        $stmt->bindValue(':deleted',    'N',        \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(Profession $profession): int
    {
        $this->db->setExecutedMethod('ProfessionRepository -> insert');

        $registration = $profession->getRegistration();

        $sql = "INSERT INTO profession (company_id,
                                        description,
                                        registration_date,
                                        registration_time,
                                        registration_timestamp,
                                        registration_unix_timestamp,
                                        registration_level,
                                        registration_user_id)
                                    VALUES
                                       (:company_id,
                                        :description,
                                        :registration_date,
                                        :registration_time,
                                        :registration_timestamp,
                                        :registration_unix_timestamp,
                                        :registration_level,
                                        :registration_user_id);";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':company_id',                  $profession->getCompanyId(),       \PDO::PARAM_INT);
        $stmt->bindValue(':description',                 $profession->getDescription(),     \PDO::PARAM_STR);
        $stmt->bindValue(':registration_date',           $registration->getDate(),          \PDO::PARAM_STR);
        $stmt->bindValue(':registration_time',           $registration->getTime(),          \PDO::PARAM_STR);
        $stmt->bindValue(':registration_timestamp',      $registration->getTimestamp(),     \PDO::PARAM_STR);
        $stmt->bindValue(':registration_unix_timestamp', $registration->getUnixTimestamp(), \PDO::PARAM_STR);
        $stmt->bindValue(':registration_level',          $registration->getLevel(),         \PDO::PARAM_STR);
        $stmt->bindValue(':registration_user_id',        $registration->getUserId(),        \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $this->db->lastIdInserted();
    }

    public function update(Profession $profession): bool
    {
        $this->db->setExecutedMethod('ProfessionRepository -> update');

        $sql = "UPDATE profession
                SET description = :description
                WHERE (profession_id = :profession_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':profession_id', $profession->getId(),          \PDO::PARAM_INT);
        $stmt->bindValue(':description',      $profession->getDescription(), \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }

    public function delete(Delete $delete): bool
    {
        $this->db->setExecutedMethod('ProfessionRepository -> delete');

        $sql = "UPDATE profession
                SET deleted         = :deleted,
                    deleted_date    = :deleted_date,
                    deleted_time    = :deleted_time,
                    deleted_level   = :deleted_level,
                    deleted_user_id = :deleted_user_id
                WHERE (profession_id  = :profession_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':profession_id',   $delete->getRecordId(), \PDO::PARAM_INT);
        $stmt->bindValue(':deleted',         $delete->getDeleted(),  \PDO::PARAM_STR);
        $stmt->bindValue(':deleted_date',    $delete->getDate(),     \PDO::PARAM_STR);
        $stmt->bindValue(':deleted_time',    $delete->getTime(),     \PDO::PARAM_STR);
        $stmt->bindValue(':deleted_level',   $delete->getLevel(),    \PDO::PARAM_STR);
        $stmt->bindValue(':deleted_user_id', $delete->getUserId(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }
}
