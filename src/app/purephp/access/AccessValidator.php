<?php

namespace coderaiz\app\purephp\access;

class AccessValidator
{
    protected Access $chainOfAccess;

    public function __construct(Access $chainOfAccess) {
        $this->chainOfAccess = $chainOfAccess;
    }

    public function validate(string $context): void
    {
        $this->chainOfAccess->execute($context);
    }
}