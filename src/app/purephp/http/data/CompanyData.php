<?php

namespace coderaiz\app\purephp\http\data;

use devraiz\FilterTrait;
use devraiz\SecurityTrait;
use devraiz\StringTrait;
use DI\Attribute\Inject;
use coderaiz\domain\company\entity\Company;
use coderaiz\domain\Email;

class CompanyData
{
    use FilterTrait;
    use SecurityTrait;
    use StringTrait;

    #[Inject]
    private Company $company;

    #[Inject]
    private Email $email;

    public function getCompany(array $params): Company
    {
        $companyId = (int) ($params['company_id'] !== '0') ? $this->decrypt($params['company_id']) : 0;
        $this->company->setId($companyId);

        $corporateName = $this->filterChars($params['corporate_name']);
        $this->company->setCorporateName($corporateName);

        $name = $this->filterChars($params['name']);
        $this->company->setName($name);

        if (isset($params['cnpj']) === true) {
            $cnpj = $this->filterChars($params['cnpj']);
            $cnpj = $this->filterCnpj($cnpj);
            $this->company->setCnpj($cnpj);
        }

        $email = $this->filterChars($params['email']);
        $this->email->setEmail($email);
        $this->company->setEmail($this->email);

        $phone = $this->filterChars($params['phone']);
        $phone = $this->filterWhatsapp($phone);
        $this->company->setPhone($phone);

        $this->company->setRegistrationDate(TODAY);
        $this->company->setRegistrationTime(NOW);
        $this->company->setRegistrationTimestamp(TIMESTAMP);

        return $this->company;
    }
}
