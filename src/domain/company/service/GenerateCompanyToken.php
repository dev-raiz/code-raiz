<?php

namespace coderaiz\domain\company\service;

use devraiz\SecurityTrait;
use coderaiz\app\purephp\core\Jwt;
use coderaiz\domain\company\entity\Company;

class GenerateCompanyToken
{
    use SecurityTrait;

    private Jwt $jwt;

    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    public function execute(Company $company): string
    {
        $payload  = $company->getId() . '|'; // ID Empresa
        $payload .= $company->getCnpj();     // CNPJ

        $jti = $this->encrypt($payload);

        $this->jwt->addPayload('jti', $jti); // ID único do token
        $this->jwt->addPayload('iat', $company->getRegistrationTimestamp()); // Momento em que o JWT foi criado

        return $this->jwt->token();
    }
}
