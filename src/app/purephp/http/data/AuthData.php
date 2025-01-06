<?php

namespace coderaiz\app\purephp\http\data;

use DI\Attribute\Inject;
use devraiz\FilterTrait;
use coderaiz\domain\auth\entity\Auth;
use coderaiz\domain\Email;
use coderaiz\domain\Password;

class AuthData
{
    use FilterTrait;

    #[Inject]
    private Auth $auth;

    #[Inject]
    private Email $email;

    #[Inject]
    private Password $password;

    public function __construct() {
    }

    public function getAuth(array $params) : Auth
    {
        $email    = $this->filterEmail($params['email']);
        $password = $params['password'];

        $this->email->setEmail($email);
        $this->password->setPassword($password);

        $this->auth->setEmail($this->email);
        $this->auth->setPassword($this->password);

        return $this->auth;
    }
}