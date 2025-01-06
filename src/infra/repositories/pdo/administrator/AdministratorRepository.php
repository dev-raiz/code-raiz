<?php

namespace coderaiz\infra\repositories\pdo\administrator;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\administrator\entity\Administrator;
use coderaiz\domain\administrator\repository\AdministratorRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class AdministratorRepository implements AdministratorRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance();
    }

    public function findId(int $administratorId): bool|array
    {
        $this->db->setExecutedMethod('AdministratorRepository -> findId');

        $sql = "SELECT a.administrator_id,
                       b.social_name
                FROM administrator AS a
                LEFT JOIN person   AS b ON (a.person_id = b.person_id)
                WHERE (a.administrator_id = :administrator_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':administrator_id', $administratorId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findPersonId(int $personId): bool|array
    {
        $this->db->setExecutedMethod('AdministratorRepository -> findPersonId');

        $sql = "SELECT a.administrator_id,
                       b.social_name
                FROM administrator AS a
                LEFT JOIN person   AS b ON (a.person_id = b.person_id)
                WHERE (a.person_id = :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':person_id', $personId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function totalOfRecords(): int
    {
        $this->db->setExecutedMethod('AdministratorRepository -> totalOfRecords');

        $sql = "SELECT COUNT(administrator_id) AS total
                FROM administrator;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchAllWithPagination(Pagination $pagination): array
    {
        $this->db->setExecutedMethod('AdministratorRepository -> fetchAllWithPagination');

        $sql = "SELECT administrator_id
                FROM administrator
                ORDER BY administrator_id DESC
                LIMIT :start, :end;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':start', $pagination->getStart(), \PDO::PARAM_INT);
        $stmt->bindValue(':end',   $pagination->getEnd(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(Administrator $administrator): int
    {
        $this->db->setExecutedMethod('AdministratorRepository -> insert');

        $sql = "INSERT INTO administrator (id_person,
                                     status)
                                    VALUES
                                    (:id_person,
                                     'A')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_person', $administrator->getPersonId(), \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $this->db->lastIdInserted();
    }

    public function update(Administrator $administrator): bool
    {
        $this->db->setExecutedMethod('AdministratorRepository -> update');

        $sql = "UPDATE administrator
                SET status = :status
                WHERE (administrator_id = :administrator_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':administrator_id', $administrator->getId(),     \PDO::PARAM_INT);
        $stmt->bindValue(':status',           $administrator->getStatus(), \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }
}
