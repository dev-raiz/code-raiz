<?php

namespace coderaiz\app\purephp\http\data;

use devraiz\FilterTrait;
use devraiz\SecurityTrait;
use DI\Attribute\Inject;
use coderaiz\domain\profession\entity\Profession;
use coderaiz\domain\Registration;

class ProfessionData
{
    use FilterTrait;
    use SecurityTrait;

    #[Inject]
    private Profession $profession;

    #[Inject]
    private Registration $registration;

    public function getProfession(array $params): Profession
    {
        if (isset($params['profession_id']) === true) {
            if (CONTEXT === 'api') {
                $professionId = (int) $params['profession_id'];
            } else {
                $professionId = (int) ($params['profession_id'] !== '0') ? $this->decrypt($params['profession_id']) : 0;
            }

            $this->profession->setId($professionId);
        }

        $this->profession->setCompanyId(COMPANY_ID);

        $description = $this->filterChars($params['description']);
        $this->profession->setDescription($description);

        $this->registration->setDate(TODAY);
        $this->registration->setTime(NOW);
        $this->registration->setTimestamp(TIMESTAMP);
        $this->registration->setUnixTimestamp(UNIX_TIMESTAMP);
        $this->registration->setLevel(USER_LEVEL);
        $this->registration->setUserId(USER_ID);

        $this->profession->setRegistration($this->registration);

        return $this->profession;
    }
}
