<?php

return [
    coderaiz\infra\repositories\DatabaseInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\DB::class),

    devraiz\FileServiceInterface::class  => function () {
        return new devraiz\FileS3Service(
            S3_VERSION,
            S3_REGION,
            S3_ENDPOINT,
            S3_KEY,
            S3_SECRET,
            S3_BUCKET
        );
    },

    PHPMailer\PHPMailer\PHPMailer::class => function () {
        return new PHPMailer\PHPMailer\PHPMailer(true);
    },

    coderaiz\domain\company\service\CompanyServiceInterface::class       => DI\autowire(coderaiz\domain\company\service\CompanyService::class),
    coderaiz\domain\company\repository\CompanyRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\company\CompanyRepository::class),

    coderaiz\domain\person\service\PersonServiceInterface::class       => DI\autowire(coderaiz\domain\person\service\PersonService::class),
    coderaiz\domain\person\repository\PersonRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\person\PersonRepository::class),

    coderaiz\domain\administrator\service\AdministratorServiceInterface::class       => DI\autowire(coderaiz\domain\administrator\service\AdministratorService::class),
    coderaiz\domain\administrator\repository\AdministratorRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\administrator\AdministratorRepository::class),

    coderaiz\domain\user\service\UserServiceInterface::class       => DI\autowire(coderaiz\domain\user\service\UserService::class),
    coderaiz\domain\user\repository\UserRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\user\UserRepository::class),

    coderaiz\domain\profession\service\ProfessionServiceInterface::class       => DI\autowire(coderaiz\domain\profession\service\ProfessionService::class),
    coderaiz\domain\profession\repository\ProfessionRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\profession\ProfessionRepository::class),

    coderaiz\domain\employee\service\EmployeeServiceInterface::class       => DI\autowire(coderaiz\domain\employee\service\EmployeeService::class),
    coderaiz\domain\employee\repository\EmployeeRepositoryInterface::class => DI\autowire(coderaiz\infra\repositories\pdo\employee\EmployeeRepository::class),
];
