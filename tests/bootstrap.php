<?php

require dirname(__FILE__).'/SplClassLoader.php';

$autoLoader = new SplClassLoader('PhpDesignPrinciples', dirname(__FILE__).'/../src');
$autoLoader->register();

require_once __DIR__.'/../vendor/autoload.php';