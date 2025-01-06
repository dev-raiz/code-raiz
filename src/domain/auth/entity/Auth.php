<?php

namespace coderaiz\domain\auth\entity;

use coderaiz\domain\Email;
use coderaiz\domain\Password;

class Auth
{
    private Email $email;
    private Password $password;

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
}
