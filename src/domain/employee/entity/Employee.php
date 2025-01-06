<?php

namespace coderaiz\domain\employee\entity;

use coderaiz\domain\person\entity\Person;
use coderaiz\domain\Registration;

class Employee
{
    private int $id;
    private int $companyId;
    private Person $person;
    private ?int $professionId   = NULL;
    private float $pricePerHour  = 0.00;
    private ?string $observation = NULL;
    private string $status = 'A';
    private Registration $registration;

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
     * Get the value of professionId
     */
    public function getProfessionId(): ?int
    {
        return $this->professionId;
    }

    /**
     * Set the value of professionId
     */
    public function setProfessionId(?int $professionId): self
    {
        $this->professionId = $professionId;

        return $this;
    }

    /**
     * Get the value of pricePerHour
     */
    public function getPricePerHour(): float
    {
        return $this->pricePerHour;
    }

    /**
     * Set the value of pricePerHour
     */
    public function setPricePerHour(float $pricePerHour): self
    {
        $this->pricePerHour = $pricePerHour;

        return $this;
    }

    /**
     * Get the value of observation
     */
    public function getObservation(): ?string
    {
        return $this->observation;
    }

    /**
     * Set the value of observation
     */
    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

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
     * Get the value of registration
     */
    public function getRegistration(): Registration
    {
        return $this->registration;
    }

    /**
     * Set the value of registration
     */
    public function setRegistration(Registration $registration): self
    {
        $this->registration = $registration;

        return $this;
    }
}
