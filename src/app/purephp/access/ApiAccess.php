<?php

namespace coderaiz\app\purephp\access;

class ApiAccess extends Access
{
    public function execute(string $context): void
    {
        if ($context === 'api') {
            header("Content-type: application/json; charset=utf-8");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            header("Access-Control-Allow-Methods: GET, POST");
            header("Access-Control-Allow-Origin: *");

            $headers = apache_request_headers();
            $existAuthorization = isset($headers['Authorization']);

            if ($existAuthorization === false) {
                throw new \Exception('Cabeçalho Authorization não enviado!', 400);
            }

            # Remove o Bearer do cabeçalho Authorization para pegar somente o token
            $token = str_replace("Bearer ", "", $headers['Authorization']);

            if ($this->jwt->tokenIsValid($token) === false) {
                throw new \Exception('Token inválido!', 405);
            }

            $tokenParsed = $this->jwt->parse($token);
            $vector = explode('|', $this->decrypt($tokenParsed['payload']['jti']));

            if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
                $params = json_decode(file_get_contents('php://input'), true);
            } else if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
                parse_str($_SERVER['QUERY_STRING'], $params);
            } else {
                throw new \Exception('Requisição inválida! Apenas GET e POST são permitidos.', 405);
            }

            define('COMPANY_ID', $vector[0]);
            define('USER_ID', 0);
            define('USER_LEVEL', 'api');
            define('CONTEXT',    'api');
            define('PARAMS', $params);

            $company = $this->companyService->search(COMPANY_ID);

            if ($company === false) {
                throw new \Exception('Empresa inválida!', 422);
            }

            define('COMPANY_DATA', $company);
        } else {
            $this->nextAccess->execute($context);
        }
    }
}
