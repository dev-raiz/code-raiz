<?php

namespace coderaiz\domain;

class Email
{
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \Exception('E-mail inválido!');
        }

        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return $this;
    }
}