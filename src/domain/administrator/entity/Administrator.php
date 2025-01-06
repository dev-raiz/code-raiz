<?php

namespace coderaiz\domain\administrator\entity;

class Administrator
{
    private int $id;
    private int $personId;
    private string $status = 'A';

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
     * Get the value of personId
     */
    public function getPersonId(): int
    {
        return $this->personId;
    }

    /**
     * Set the value of personId
     */
    public function setPersonId(int $personId): self
    {
        $this->personId = $personId;

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
}