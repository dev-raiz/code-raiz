<?php

use DI\ContainerBuilder;
use coderaiz\app\purephp\access\AccessFactory;
use coderaiz\app\purephp\core\Context;
use coderaiz\app\purephp\core\Router;

require '../vendor/autoload.php';
require '../src/infra/config/config.php';

$httpRequest = $_SERVER['REQUEST_METHOD'];

$context = Context::get();

$router = new Router();
$route  = $router->getRoute();
$action = $router->getAction();

if (array_search($context, ['web', 'panel', 'api']) === false) {
    http_response_code(404);
    exit;
}

if (file_exists('../src/infra/config/' . $context . '/config.php') === true) {
    require '../src/infra/config/' . $context . '/config.php';
}

$pathDependencies = '../src/infra/config/dependencies.php';
$pathRoutes       = '../src/infra/routes/' . $context . '/' . $route . '.php';

if (file_exists($pathRoutes) === false) {
    http_response_code(404);
    exit;
}

// $pathDependenciesRoute = '../src/infra/config/' . $context . '/dependencies/' . $route . '/config.php';
// if (file_exists($pathDependenciesRoute) === true) {
//     $pathDependencies = $pathDependenciesRoute;
// }

$routes = require $pathRoutes;

$key = $httpRequest . '|' . $action;

if (array_key_exists($key, $routes) === false) {
    http_response_code(404);
    exit;
}

session_start();

// Se a rota não for escrita corretamente
if (is_array($routes[$key]) === false) {
    http_response_code(501);
    exit;
}

try {
    if ($routes[$key][1] === 'private') {
        $validator = (new AccessFactory())->create();
        $validator->validate($context);
    }

    $class = $routes[$key][0];

    $builder = new ContainerBuilder();
    $builder->useAttributes(true);
    $builder->addDefinitions($pathDependencies);

    $container = $builder->build();

    $controller = $container->get($class);
    $controller->run();
} catch (\Exception $e) {
    http_response_code($e->getCode());
    echo json_encode([
        'result' => 'warning',
        'message' => $e->getMessage()
    ]);
}
