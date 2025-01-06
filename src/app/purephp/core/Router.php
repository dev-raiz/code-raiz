<?php

namespace coderaiz\app\purephp\core;

class Router
{
    private string $route;
    private string $action;

    public function __construct() {
        $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $url = filter_var($url, FILTER_SANITIZE_URL);

        $arrayRoutes  = explode('/', $url);
        $this->route  = (isset($arrayRoutes[1]) === false || $arrayRoutes[1] === '') ? 'login' : $arrayRoutes[1];
        $this->action = (isset($arrayRoutes[2]) === true) ? $arrayRoutes[2] : $this->route;

        $arrayRoutes[1] = $this->route;
        $arrayRoutes[2] = $this->action;

        define('URL_PARAMS', $arrayRoutes);
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function isLogin(): bool
    {
        return ($this->route === 'login');
    }
}