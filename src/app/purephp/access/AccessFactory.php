<?php

namespace coderaiz\app\purephp\access;

use coderaiz\app\purephp\core\Jwt;
use coderaiz\domain\company\service\CompanyService;
use coderaiz\infra\repositories\pdo\company\CompanyRepository;
use coderaiz\infra\repositories\pdo\DB;

class AccessFactory
{
    public function create(): AccessValidator
    {
        $jwt = new Jwt();

        $database          = new DB();
        $companyRepository = new CompanyRepository($database);
        $companyService    = new CompanyService($companyRepository);

        $appAccess   = new AppAccess(NULL, $jwt, $companyService);
        $panelAccess = new PanelAccess($appAccess, $jwt, $companyService);
        $apiAccess   = new ApiAccess($panelAccess, $jwt, $companyService);

        return new AccessValidator($apiAccess);
    }
}
