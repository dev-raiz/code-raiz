<?php

namespace coderaiz\domain\profession\entity;

use coderaiz\domain\Registration;

class Profession
{
    private int $id;
    private int $companyId;
    private string $description;
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
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

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
