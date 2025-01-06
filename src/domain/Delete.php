<?php

namespace coderaiz\domain;

class Delete
{
    private int $recordId;
    private string $deleted = 'N';
    private ?string $date   = NULL;
    private ?string $time   = NULL;
    private ?string $timestamp     = NULL;
    private ?string $unixTimestamp = NULL;
    private string $level   = 'none';
    private ?int $userId    = NULL;
    private array $deletedParams = [];

    /**
     * Get the value of recordId
     */
    public function getRecordId(): int
    {
        return $this->recordId;
    }

    /**
     * Set the value of recordId
     */
    public function setRecordId(int $recordId): self
    {
        $this->recordId = $recordId;

        return $this;
    }

    /**
     * Get the value of deleted
     */
    public function getDeleted(): string
    {
        return $this->deleted;
    }

    /**
     * Set the value of deleted
     */
    public function setDeleted(string $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * Set the value of time
     */
    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of timestamp
     */
    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     */
    public function setTimestamp(?string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get the value of unixTimestamp
     */
    public function getUnixTimestamp(): ?string
    {
        return $this->unixTimestamp;
    }

    /**
     * Set the value of unixTimestamp
     */
    public function setUnixTimestamp(?string $unixTimestamp): self
    {
        $this->unixTimestamp = $unixTimestamp;

        return $this;
    }

    /**
     * Get the value of level
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * Set the value of level
     */
    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of deletedParams
     */
    public function getDeletedParams(): array
    {
        return $this->deletedParams;
    }

    /**
     * Set the value of deletedParams
     */
    public function setDeletedParams(array $deletedParams): self
    {
        $this->deletedParams = $deletedParams;

        return $this;
    }
}
