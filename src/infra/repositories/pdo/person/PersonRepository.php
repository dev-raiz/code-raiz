<?php

namespace coderaiz\infra\repositories\pdo\person;

use coderaiz\domain\person\entity\Person;
use coderaiz\domain\person\repository\PersonRepositoryInterface;
use coderaiz\infra\repositories\DatabaseInterface;

class PersonRepository implements PersonRepositoryInterface
{
    private DatabaseInterface $db;
    private \PDO $conn;

    public function __construct(DatabaseInterface $db)
    {
        $this->db   = $db;
        $this->conn = $db->getInstance();
    }

    public function findId(int $personId): bool|array
    {
        $this->db->setExecutedMethod('PersonRepository -> findId');

        $sql  = "SELECT *
                 FROM person
                 WHERE (person_id = :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':person_id', $personId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findDocument(string $document): bool|array
    {
        $this->db->setExecutedMethod('PersonRepository -> findDocument');

        $sql = "SELECT document
                FROM person
                WHERE (document = :document);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':document', $document, \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findDocumentOnAnotherId(int $personId, string $document): bool|array
    {
        $this->db->setExecutedMethod('PersonRepository -> findDocumentOnAnotherId');

        $sql = "SELECT person_id
                FROM person
                WHERE (document = :document)
                AND   (person_id <> :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':document',  $document, \PDO::PARAM_STR);
        $stmt->bindValue(':person_id', $personId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findEmail(string $email): bool|array
    {
        $this->db->setExecutedMethod('PersonRepository -> findEmail');

        $sql = "SELECT person_id,
                       social_name,
                       email,
                       password
                FROM person
                WHERE (email = :email);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findEmailOnAnotherId(int $personId, string $email): bool|array
    {
        $this->db->setExecutedMethod('PersonRepository -> findEmailOnAnotherId');

        $sql = "SELECT person_id
                FROM person
                WHERE (email = :email)
                AND   (person_id <> :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':email',     $email,    \PDO::PARAM_STR);
        $stmt->bindValue(':person_id', $personId, \PDO::PARAM_INT);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(Person $person): int
    {
        $this->db->setExecutedMethod('PersonRepository -> insert');

        $registration = $person->getRegistration();

        $sql = "INSERT INTO person (document,
                                    name,
                                    middle_name,
                                    surname,
                                    social_name,
                                    date_of_birth,
                                    email,
                                    password,
                                    phone,
                                    registration_date,
                                    registration_time,
                                    registration_timestamp,
                                    registration_unix_timestamp,
                                    registration_level,
                                    registration_user_id)
                                   VALUES
                                   (:document,
                                    :name,
                                    :middle_name,
                                    :surname,
                                    :social_name,
                                    :date_of_birth,
                                    :email,
                                    :password,
                                    :phone,
                                    :registration_date,
                                    :registration_time,
                                    :registration_timestamp,
                                    :registration_unix_timestamp,
                                    :registration_level,
                                    :registration_user_id);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':document',                    $person->getDocument(),            \PDO::PARAM_STR);
        $stmt->bindValue(':name',                        $person->getName(),                \PDO::PARAM_STR);
        $stmt->bindValue(':middle_name',                 $person->getMiddleName(),          \PDO::PARAM_STR);
        $stmt->bindValue(':surname',                     $person->getSurname(),             \PDO::PARAM_STR);
        $stmt->bindValue(':social_name',                 $person->getSocialName(),          \PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth',               $person->getDateOfBirth(),         \PDO::PARAM_STR);
        $stmt->bindValue(':email',                       $person->getEmail(),               \PDO::PARAM_STR);
        $stmt->bindValue(':password',                    $person->getPassword()->encrypt(), \PDO::PARAM_STR);
        $stmt->bindValue(':phone',                       $person->getPhone(),               \PDO::PARAM_STR);
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

    public function update(Person $person): bool
    {
        $this->db->setExecutedMethod('PersonRepository -> update');

        $sql = "UPDATE person
                SET document      = :document,
                    name          = :name,
                    middle_name   = :middle_name,
                    surname       = :surname,
                    social_name   = :social_name,
                    date_of_birth = :date_of_birth,
                    email         = :email,
                    phone         = :phone
                WHERE (person_id = :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':person_id',     $person->getId(),            \PDO::PARAM_INT);
        $stmt->bindValue(':document',          $person->getDocument(),         \PDO::PARAM_STR);
        $stmt->bindValue(':name',                        $person->getName(),                \PDO::PARAM_STR);
        $stmt->bindValue(':middle_name',                 $person->getMiddleName(),          \PDO::PARAM_STR);
        $stmt->bindValue(':surname',                     $person->getSurname(),             \PDO::PARAM_STR);
        $stmt->bindValue(':social_name',                 $person->getSocialName(),          \PDO::PARAM_STR);
        $stmt->bindValue(':date_of_birth',               $person->getDateOfBirth(),         \PDO::PARAM_STR);
        $stmt->bindValue(':email',             $person->getEmail(),            \PDO::PARAM_STR);
        $stmt->bindValue(':phone',             $person->getPhone(),            \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }

    public function updatePassword(Person $person): bool
    {
        $this->db->setExecutedMethod('PersonRepository -> updatePassword');

        $sql = "UPDATE person
                SET password = :password
                WHERE (person_id = :person_id);";
        $stmt = $this->conn->prepare($sql) or $this->db->instanceException();
        $stmt->bindValue(':person_id', $person->getId(),                  \PDO::PARAM_INT);
        $stmt->bindValue(':password',  $person->getPassword()->encrypt(), \PDO::PARAM_STR);

        $exec = $stmt->execute();
        $this->db->executionException($exec, $stmt);

        return $exec;
    }
}
