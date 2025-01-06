<?php

namespace coderaiz\domain\person\entity;

use coderaiz\domain\Email;
use coderaiz\domain\Password;
use coderaiz\domain\Registration;

class Person
{
    private int $id;
    private string $document;
    private string $name;
    private ?string $middleName = NULL;
    private ?string $surname    = NULL;
    private string $socialName;
    private ?string $dateOfBirth = NULL;
    private Email $email;
    private Password $password;
    private string $phone;
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
     * Get the value of document
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * Set the value of document
     */
    public function setDocument(string $document): self
    {
        $this->document = $document;

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
     * Get the value of middleName
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * Set the value of middleName
     */
    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     */
    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of socialName
     */
    public function getSocialName(): string
    {
        return $this->socialName;
    }

    /**
     * Set the value of socialName
     */
    public function setSocialName(string $socialName): self
    {
        $this->socialName = $socialName;

        return $this;
    }

    /**
     * Get the value of dateOfBirth
     */
    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    /**
     * Set the value of dateOfBirth
     */
    public function setDateOfBirth(?string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

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
     * Get the value of password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(Password $password): self
    {
        $this->password = $password;

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
