#!usr/bin/php
<?php

 require_once 'vendor/autoload.php';
require_once 'system/autoload.php';
$params     = array_slice($argv, 1);
$console    = new system\libary\console();
echo $console->run($params);