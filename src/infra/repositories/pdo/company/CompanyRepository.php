<?php

namespace coderaiz\infra\repositories\pdo\company;

use coderaiz\app\purephp\Pagination;
use coderaiz\domain\company\entity\Company;
use coderaiz\domain\company\repository\CompanyRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance();
    }

    public function findId(int $companyId): bool|array
    {
        $this->db->setExecutedMethod('CompanyRepository -> findId');

        $sql = "SELECT *
                FROM company
                WHERE (company_id = :company_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function totalOfRecords(): int
    {
        $this->db->setExecutedMethod('CompanyRepository -> totalOfRecords');

        $sql = "SELECT COUNT(company_id) AS total
                FROM company;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        
        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchAllWithPagination(Pagination $pagination): array
    {
        $this->db->setExecutedMethod('CompanyRepository -> fetchAllWithPagination');

        $sql = "SELECT company_id,
                       cnpj,
                       name,
                       token
                FROM company
                ORDER BY company_id DESC
                LIMIT :start, :end;";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':start', $pagination->getStart(), \PDO::PARAM_INT);
        $stmt->bindValue(':end',   $pagination->getEnd(),   \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(Company $company): int
    {
        $this->db->setExecutedMethod('CompanyRepository -> insert');

        $sql = "INSERT INTO company (cnpj,
                                     corporate_name,
                                     name,
                                     phone,
                                     email,
                                     registration_date,
                                     registration_time,
                                     registration_timestamp)
                                    VALUES
                                    (:cnpj,
                                     :corporate_name,
                                     :name,
                                     :phone,
                                     :email,
                                     :registration_date,
                                     :registration_time,
                                     :registration_timestamp)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':cnpj',                   $company->getCnpj(),                  \PDO::PARAM_STR);
        $stmt->bindValue(':corporate_name',         $company->getCorporateName(),         \PDO::PARAM_STR);
        $stmt->bindValue(':name',                   $company->getName(),                  \PDO::PARAM_STR);
        $stmt->bindValue(':phone',                  $company->getPhone(),                 \PDO::PARAM_STR);
        $stmt->bindValue(':email',                  $company->getEmail(),                 \PDO::PARAM_STR);
        $stmt->bindValue(':registration_date',      $company->getRegistrationDate(),      \PDO::PARAM_STR);
        $stmt->bindValue(':registration_time',      $company->getRegistrationTime(),      \PDO::PARAM_STR);
        $stmt->bindValue(':registration_timestamp', $company->getRegistrationTimestamp(), \PDO::PARAM_STR);
        
        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return (int) $this->db->lastIdInserted();
    }

    public function update(Company $company): bool
    {
        $this->db->setExecutedMethod('CompanyRepository -> update');

        $sql = "UPDATE company
                SET cnpj           = :cnpj,
                    corporate_name = :corporate_name,
                    name           = :name,
                    phone          = :phone,
                    email          = :email
                WHERE (company_id = :company_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id',     $company->getId(),            \PDO::PARAM_INT);
        $stmt->bindValue(':cnpj',           $company->getCnpj(),          \PDO::PARAM_STR);
        $stmt->bindValue(':corporate_name', $company->getCorporateName(), \PDO::PARAM_STR);
        $stmt->bindValue(':name',           $company->getName(),          \PDO::PARAM_STR);
        $stmt->bindValue(':phone',          $company->getPhone(),         \PDO::PARAM_STR);
        $stmt->bindValue(':email',          $company->getEmail(),         \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }

    public function updateToken(int $companyId, string $token): bool
    {
        $this->db->setExecutedMethod('CompanyRepository -> updateToken');

        $sql = "UPDATE company
                SET token = :token
                WHERE (company_id = :company_id)";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':company_id', $companyId, \PDO::PARAM_INT);
        $stmt->bindValue(':token',      $token,     \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }
}
