<?php

namespace coderaiz\app\purephp;

interface FilterInterface
{
    public function filter(array $params): void;
}
