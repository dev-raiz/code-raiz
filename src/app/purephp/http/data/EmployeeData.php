<?php

namespace coderaiz\app\purephp\http\data;

use coderaiz\app\purephp\core\Data;
use devraiz\FilterTrait;
use devraiz\SecurityTrait;
use DI\Attribute\Inject;
use coderaiz\domain\employee\entity\Employee;
use coderaiz\domain\Registration;

class EmployeeData extends Data
{
    use FilterTrait;
    use SecurityTrait;

    #[Inject]
    private Employee $employee;

    #[Inject]
    private PersonData $personData;

    #[Inject]
    private Registration $registration;

    public function getEmployee(array $params): Employee
    {
        $this->validateData($params, $this->getRequiredFileds());

        if (CONTEXT === 'api') {
            $employeeId   = (int) (isset($params['employee_id']) === true) ? $params['employee_id'] : 0;
            $professionId = (int) $params['profession'];
            $pricePerHour = $params['price_per_hour'];
            $status       = $params['status'];
        } else {
            $employeeId   = (int) ($params['employee_id'] !== '0') ? $this->decrypt($params['employee_id']) : 0;
            $professionId = (int) $this->decrypt($params['profession']);
            $pricePerHour = $this->filterDecimal($params['price_per_hour']);
            $status = $this->decrypt($params['status']);
        }
        
        $this->employee->setId($employeeId);
        $this->employee->setCompanyId(COMPANY_ID);

        $person = $this->personData->getPerson($params);
        $this->employee->setPerson($person);

        $this->employee->setProfessionId($professionId);

        $this->employee->setPricePerHour($pricePerHour);

        if (empty($params['observation']) === false) {
            $observation = $this->filterChars($params['observation']);
            $this->employee->setObservation($observation);
        }

        if (isset($params['status']) === true) {
            
            $this->employee->setStatus($status);
        }

        $this->employee->setRegistration($person->getRegistration());

        return $this->employee;
    }

    private function getRequiredFileds() : array
    {
        $requiredFields = array(
            'profession' => array(
                'description' => 'Profissão',
                'type'        => 'int'
            ),
            'price_per_hour' => array(
                'description' => 'Valor de Hora',
                'type'        => 'decimal',
                'lenght'      => '15'
            ),
        );

        return $requiredFields;
    }
}
