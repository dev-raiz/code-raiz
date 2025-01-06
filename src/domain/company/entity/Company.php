<?php

namespace coderaiz\domain\company\entity;

use coderaiz\domain\Email;

class Company
{
    private int $id;
    private string $cnpj;
    private string $corporateName;
    private string $name;
    private string $phone;
    private Email $email;
    private ?string $token = NULL;
    private string $registrationDate;
    private string $registrationTime;
    private string $registrationTimestamp;

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
     * Get the value of cnpj
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     */
    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get the value of corporateName
     */
    public function getCorporateName(): string
    {
        return $this->corporateName;
    }

    /**
     * Set the value of corporateName
     */
    public function setCorporateName(string $corporateName): self
    {
        $this->corporateName = $corporateName;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set the value of token
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

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

    /**
     * Get the value of registrationTimestamp
     */
    public function getRegistrationTimestamp(): string
    {
        return $this->registrationTimestamp;
    }

    /**
     * Set the value of registrationTimestamp
     */
    public function setRegistrationTimestamp(string $registrationTimestamp): self
    {
        $this->registrationTimestamp = $registrationTimestamp;

        return $this;
    }
}