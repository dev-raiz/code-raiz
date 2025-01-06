<?php

namespace coderaiz\app\purephp\core;

class Context
{
    private function __construct()
    {
    }

    public static function get(): string
    {
        $domain      = $_SERVER['HTTP_HOST'];
        $domainParts = explode('.', $domain);

        $subDomain = strtolower($domainParts[0]);

        if ($subDomain === 'app') {
            return 'web';
        } else if ($subDomain === 'painel') {
            return 'panel';
        } else if ($subDomain === 'api') {
            return 'api';
        }

        return 'site';
    }
}
