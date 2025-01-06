<?php

namespace coderaiz\app\purephp\http\data;

use devraiz\FilterTrait;
use devraiz\SecurityTrait;
use devraiz\StringTrait;
use DI\Attribute\Inject;
use coderaiz\domain\user\entity\User;

class UserData
{
    use FilterTrait;
    use SecurityTrait;
    use StringTrait;

    #[Inject]
    private User $user;

    #[Inject]
    private PersonData $personData;

    public function getUser(array $params): User
    {
        $person = $this->personData->getPerson($params);
        $this->user->setPerson($person);

        $userId = (int) $this->decrypt($params['user_id']);
        $this->user->setId($userId);

        $companyId = (int) $this->decrypt($params['company_id']);
        $this->user->setCompanyId($companyId);

        if (isset($params['status']) === true) {
            $status = $this->decrypt($params['status']);
            $status = $this->filterChars($status);
            $this->user->setStatus($status);
        }

        $this->user->setRegistrationDate(TODAY);
        $this->user->setRegistrationTime(NOW);

        return $this->user;
    }
}
