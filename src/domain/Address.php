<?php

namespace coderaiz\domain;

class Address
{
    private string $zipCode;
    private string $address;
    private string $number;
    private ?string $complement = NULL;
    private string $district;
    private string $city;
    private string $state;
    private string $ibgeCode;

    /**
     * Get the value of zipCode
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Set the value of zipCode
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of number
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set the value of number
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of complement
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * Set the value of complement
     */
    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get the value of district
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * Set the value of district
     */
    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get the value of city
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set the value of city
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of state
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Set the value of state
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of ibgeCode
     */
    public function getIbgeCode(): string
    {
        return $this->ibgeCode;
    }

    /**
     * Set the value of ibgeCode
     */
    public function setIbgeCode(string $ibgeCode): self
    {
        $this->ibgeCode = $ibgeCode;

        return $this;
    }
}
