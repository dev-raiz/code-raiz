<?php

namespace coderaiz\app\purephp\access;

use devraiz\CookieTrait;
use devraiz\ResponseTrait;
use devraiz\SecurityTrait;
use coderaiz\app\purephp\core\Jwt;
use coderaiz\domain\company\service\CompanyServiceInterface;

abstract class Access
{
    use CookieTrait;
    use SecurityTrait;
    use ResponseTrait;

    protected ?Access $nextAccess;
    protected Jwt $jwt;
    protected CompanyServiceInterface $companyService;

    public function __construct(
        ?Access $nextAccess,
        Jwt $jwt,
        CompanyServiceInterface $companyService
    ) {
        $this->nextAccess     = $nextAccess;
        $this->jwt            = $jwt;
        $this->companyService = $companyService;
    }

    abstract public function execute(string $context): void;
}
