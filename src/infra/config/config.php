<?php

$envs = parse_ini_file(__DIR__ . '/../../../.env');

foreach ($envs as $key => $value) {
    define($key, $value);
}

define('TODAY', date('Y-m-d'));
define('NOW', date('H:i:s'));
define('TIMESTAMP', TODAY . ' ' . NOW);
define('UNIX_TIMESTAMP', strtotime(TODAY . ' ' . NOW));

define('YEAR', date('Y'));
define('MONTH', date('m'));
define('DAY', date('d'));

define('PATH_CDN', 'https://cdn.emersonsilveira.com.br/shared/v1');
define('CUSTOMERS_PATH', __DIR__ . '/../../../customers/');

define('LONG_MONTH_NAME', array(
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro',
));

define('SHORT_MONTH_NAME', array(
    '01' => 'Jan',
    '02' => 'Fev',
    '03' => 'Mar',
    '04' => 'Abr',
    '05' => 'Maio',
    '06' => 'Jun',
    '07' => 'Jul',
    '08' => 'Ago',
    '09' => 'Set',
    '10' => 'Out',
    '11' => 'Nov',
    '12' => 'Dez',
));
