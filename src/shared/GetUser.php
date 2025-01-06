<?php

namespace coderaiz\shared;

use DI\Attribute\Inject;
use coderaiz\domain\administrator\service\AdministratorServiceInterface;
use coderaiz\domain\user\service\UserServiceInterface;

class GetUser
{
    #[Inject]
    private UserServiceInterface $userService;

    #[Inject]
    private AdministratorServiceInterface $adminService;

    public function __construct() {
    }

    public function execute(string $level, int $userId): array
    {
        if ($level === 'user') {
            $user = $this->userService->search($userId);
            $user['name'] = $user['social_name'];
        } else if ($level === 'master') {
            $master = $this->adminService->search($userId);
            $user['name'] = $master['social_name'] . '(master)';
        }

        if (isset($user) === false) {
            throw new \Exception('Aviso! Nível ínvalido(GetUser)');
        }

        return $user;
    }
}