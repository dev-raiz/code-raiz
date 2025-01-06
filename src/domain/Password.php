<?php

namespace coderaiz\domain;

class Password
{
    private string $password;

    public function __construct()
    {
    }

    public function __toString()
    {
        return $this->password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function encrypt(): string
    {
        return password_hash($this->password, HASH_DEFAULT);
    }

    public function verify(string $hash, string $password = NULL): bool
    {
        if (empty($password) === false) {
            return password_verify($password, $hash);
        }

        return password_verify($this->password, $hash);
    }
}
