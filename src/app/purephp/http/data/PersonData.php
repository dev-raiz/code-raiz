<?php

namespace coderaiz\app\purephp\http\data;

use coderaiz\app\purephp\core\Data;
use devraiz\FilterTrait;
use devraiz\SecurityTrait;
use devraiz\StringTrait;
use DI\Attribute\Inject;
use coderaiz\domain\person\entity\Person;
use coderaiz\domain\Email;
use coderaiz\domain\Password;
use coderaiz\domain\Registration;
use devraiz\MaskTrait;

class PersonData extends Data
{
    use FilterTrait;
    use SecurityTrait;
    use StringTrait;
    use MaskTrait;

    #[Inject]
    private Person $person;

    #[Inject]
    private Email $email;

    #[Inject]
    private Password $password;

    #[Inject]
    private Registration $registration;

    public function getPerson(array $params): Person
    {
        $this->validateData($params, $this->getRequiredFields());

        if (isset($params['person_id']) === true) {
            if (CONTEXT === 'api') {
                $personId = (int) $params['person_id'];
            } else {
                $personId = (int) ($params['person_id'] !== '0') ? $this->decrypt($params['person_id']) : 0;
            }

            $this->person->setId($personId);
        }

        $name = $this->filterChars($params['name']);
        $this->person->setName($name);

        if (empty($params['middle_name']) === false) {
            $middleName = $this->filterChars($params['middle_name']);
            $this->person->setMiddleName($middleName);
        }

        $surname = $this->filterChars($params['surname']);
        $this->person->setSurname($surname);

        $cpf = $this->filterChars($params['cpf']);
        $cpf = $this->filterCpf($cpf);
        $this->person->setDocument($cpf);

        $socialName = $this->filterChars($params['social_name']);
        $this->person->setSocialName($socialName);

        if (empty($params['date_of_birth']) === false) {
            $dateOfBirth = $this->maskDateDB($params['date_of_birth']);
            $this->person->setDateOfBirth($dateOfBirth);
        }

        $phone = $this->filterChars($params['phone']);
        $phone = $this->filterWhatsapp($phone);
        $this->person->setPhone($phone);

        $email = $this->filterChars($params['email']);
        $this->email->setEmail($email);
        $this->person->setEmail($this->email);

        $password = $this->generateString(12);
        $this->password->setPassword($password);

        $this->person->setPassword($this->password);

        $this->registration->setDate(TODAY);
        $this->registration->setTime(NOW);
        $this->registration->setTimestamp(TIMESTAMP);
        $this->registration->setUnixTimestamp(UNIX_TIMESTAMP);
        $this->registration->setLevel(USER_LEVEL);
        $this->registration->setUserId(USER_ID);

        $this->person->setRegistration($this->registration);

        return $this->person;
    }

    private function getRequiredFields(): array
    {
        $requiredFields = array(
            'cpf' => array(
                'description' => 'CPF',
                'lenght'      => 11,
                'type'        => 'string'
            ),
            'name' => array(
                'description' => 'Nome',
                'lenght'      => 20,
                'type'        => 'string'
            ),
            'middle_name' => array(
                'description' => 'Nome do meio',
                'lenght'      => 50,
                'type'        => 'string'
            ),
            'surname' => array(
                'description' => 'Sobrenome',
                'lenght'      => 20,
                'type'        => 'string'
            ),            
            'social_name' => array(
                'description' => 'Nome social',
                'lenght'      => 40,
                'type'        => 'string'
            ),
            'date_of_birth' => array(
                'description' => 'Data de nascimento',
                'lenght'      => 10,
                'type'        => 'date'
            ),
            'email' => array(
                'description' => 'Email',
                'lenght'      => 100,
                'type'        => 'string'
            ),
            'phone' => array(
                'description' => 'Telefone',
                'lenght'      => 15,
                'type'        => 'string'
            ),
        );

        return $requiredFields;
    }
}
