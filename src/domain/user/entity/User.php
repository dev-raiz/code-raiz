<?php

namespace coderaiz\domain\user\entity;

use coderaiz\domain\person\entity\Person;

class User
{
    private int $id;
    private int $companyId;
    private Person $person;
    private string $status = 'A';
    private string $registrationDate;
    private string $registrationTime;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of companyId
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * Set the value of companyId
     */
    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get the value of person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * Set the value of person
     */
    public function setPerson(Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of registrationDate
     */
    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    /**
     * Set the value of registrationDate
     */
    public function setRegistrationDate(string $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get the value of registrationTime
     */
    public function getRegistrationTime(): string
    {
        return $this->registrationTime;
    }

    /**
     * Set the value of registrationTime
     */
    public function setRegistrationTime(string $registrationTime): self
    {
        $this->registrationTime = $registrationTime;

        return $this;
    }
}
