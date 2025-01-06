<?php

namespace coderaiz\infra\repositories\pdo\user;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\user\entity\User;
use coderaiz\domain\user\repository\UserRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class UserRepository implements UserRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance();
    }

    public function findId(int $userId): bool|array
    {
        $this->db->setExecutedMethod('UserRepository -> findId');

        $sql = "SELECT a.user_id,
                       a.company_id,
                       a.person_id,
                       a.status,
                       b.document,
                       b.social_name,
                       b.email,
                       b.phone
                FROM user AS a
                LEFT JOIN person AS b ON (a.person_id = b.person_id)
                WHERE (a.user_id = :user_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':user_id', $userId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findPersonId(int $personId): bool|array
    {
        $this->db->setExecutedMethod('UserRepository -> findPersonId');

        $sql = "SELECT a.user_id,
                       a.company_id,
                       a.person_id,
                       a.status,
                       b.document,
                       b.social_name,
                       b.email,
                       b.phone
                FROM user AS a
                LEFT JOIN person AS b ON (a.person_id = b.person_id)
                WHERE (a.person_id = :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':person_id', $personId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function totalOfRecords(int $companyId): int
    {
        $this->db->setExecutedMethod('UserRepository -> totalOfRecords');

        $sql = "SELECT COUNT(user_id) AS total
                FROM user
                WHERE (company_id = :company_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array
    {
        $this->db->setExecutedMethod('UserRepository -> fetchAllWithPagination');

        $sql = "SELECT a.user_id,
                       a.person_id,
                       a.status,
                       b.social_name,
                       b.email,
                       b.phone
                FROM user AS a
                LEFT JOIN person AS b ON (a.person_id = b.person_id)
                WHERE (a.company_id = :company_id)
                ORDER BY a.user_id DESC, a.status ASC
                LIMIT :start, :end;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId,              \PDO::PARAM_INT);
        $stmt->bindValue(':start',      $pagination->getStart(), \PDO::PARAM_INT);
        $stmt->bindValue(':end',        $pagination->getEnd(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(User $user): int
    {
        $this->db->setExecutedMethod('UserRepository -> insert');

        $sql = "INSERT INTO user (company_id,
                                  person_id,
                                  status,
                                  registration_date,
                                  registration_time)
                                 VALUES
                                 (:company_id,
                                  :person_id,
                                  :status,
                                  :registration_date,
                                  :registration_time);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':company_id',        $user->getCompanyId(),        \PDO::PARAM_INT);
        $stmt->bindValue(':person_id',         $user->getPerson()->getId(),  \PDO::PARAM_INT);
        $stmt->bindValue(':status',            $user->getStatus(),           \PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $user->getRegistrationDate(), \PDO::PARAM_STR);
        $stmt->bindValue(':registration_time', $user->getRegistrationTime(), \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $this->db->lastIdInserted();
    }

    public function update(User $user): bool
    {
        $this->db->setExecutedMethod('UserRepository -> update');

        $sql = "UPDATE user
                SET status = :status
                WHERE (user_id = :user_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':user_id', $user->getId(),     \PDO::PARAM_INT);
        $stmt->bindValue(':status',  $user->getStatus(), \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }
}
