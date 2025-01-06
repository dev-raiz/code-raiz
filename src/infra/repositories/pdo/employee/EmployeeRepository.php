<?php

namespace coderaiz\infra\repositories\pdo\employee;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\Delete;
use coderaiz\domain\employee\entity\Employee;
use coderaiz\domain\employee\repository\EmployeeRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance('Y');
    }

    public function findId(int $employeeId): bool|array
    {
        $this->db->setExecutedMethod('EmployeeRepository -> findId');

        $sql = "SELECT a.employee_id,
                       a.profession_id,
                       a.price_per_hour,
                       a.observation,
                       a.status,
                       b.*
                FROM employee AS a
                INNER JOIN person AS b ON (a.person_id = b.person_id)
                WHERE (a.employee_id = :employee_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':employee_id', $employeeId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    public function totalOfRecords(int $companyId): int
    {
        $this->db->setExecutedMethod('EmployeeRepository -> totalOfRecords');

        $sql = "SELECT COUNT(employee_id) AS total
                FROM employee
                WHERE (company_id = :company_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchAllWithPagination(int $companyId, Pagination $pagination): array
    {
        $this->db->setExecutedMethod('EmployeeRepository -> fetchAllWithPagination');

        $sql = "SELECT a.employee_id,
                       a.person_id,
                       a.company_id,
                       a.profession_id,
                       a.price_per_hour,
                       a.observation,
                       a.status,
                       b.document,
                       b.name,
                       b.middle_name,
                       b.surname,
                       b.social_name,
                       CONCAT(b.name, ' ', b.middle_name, ' ', b.surname) AS full_name,
                       b.date_of_birth,
                       b.email,
                       b.phone,
                       a.registration_date,
                       a.registration_time
                FROM employee AS a
                INNER JOIN person AS b ON (a.person_id = b.person_id)
                WHERE (a.company_id = :company_id)
                ORDER BY a.status ASC, a.employee_id DESC
                LIMIT :start, :end;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId,              \PDO::PARAM_INT);
        $stmt->bindValue(':start',      $pagination->getStart(), \PDO::PARAM_INT);
        $stmt->bindValue(':end',        $pagination->getEnd(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(Employee $employee): int
    {
        $this->db->setExecutedMethod('EmployeeRepository -> insert');

        $registration = $employee->getRegistration();

        $sql = "INSERT INTO employee (company_id,
                                      person_id,
                                      profession_id,
                                      price_per_hour,
                                      observation,
                                      registration_date,
                                      registration_time,
                                      registration_timestamp,
                                      registration_unix_timestamp,
                                      registration_level,
                                      registration_user_id)
                                    VALUES
                                     (:company_id,
                                      :person_id,
                                      :profession_id,
                                      :price_per_hour,
                                      :observation,
                                      :registration_date,
                                      :registration_time,
                                      :registration_timestamp,
                                      :registration_unix_timestamp,
                                      :registration_level,
                                      :registration_user_id);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':company_id',                  $employee->getCompanyId(),         \PDO::PARAM_INT);
        $stmt->bindValue(':person_id',                   $employee->getPerson()->getId(),   \PDO::PARAM_INT);
        $stmt->bindValue(':profession_id',               $employee->getProfessionId(),      \PDO::PARAM_INT);
        $stmt->bindValue(':price_per_hour',              $employee->getPricePerHour(),      \PDO::PARAM_STR);
        $stmt->bindValue(':observation',                 $employee->getObservation(),       \PDO::PARAM_STR);
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

    public function update(Employee $employee): bool
    {
        $this->db->setExecutedMethod('EmployeeRepository -> update');

        $sql = "UPDATE employee
                SET profession_id  = :profession_id,
                    price_per_hour = :price_per_hour,
                    observation    = :observation,
                    status         = :status
                WHERE (employee_id = :employee_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':employee_id',    $employee->getId(),           \PDO::PARAM_INT);
        $stmt->bindValue(':profession_id',  $employee->getProfessionId(), \PDO::PARAM_INT);
        $stmt->bindValue(':price_per_hour', $employee->getPricePerHour(), \PDO::PARAM_STR);
        $stmt->bindValue(':observation',    $employee->getObservation(),  \PDO::PARAM_STR);
        $stmt->bindValue(':status',         $employee->getStatus(),       \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }

    public function delete(Delete $delete): bool
    {
        $this->db->setExecutedMethod('EmployeeRepository -> delete');

        $sql = "UPDATE employee
                SET deleted         = :deleted,
                    deleted_date    = :deleted_date,
                    deleted_time    = :deleted_time,
                    deleted_level   = :deleted_level,
                    deleted_user_id = :deleted_user_id
                WHERE (employee_id  = :employee_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':employee_id',     $delete->getRecordId(), \PDO::PARAM_INT);
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
