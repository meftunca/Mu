<?php


require_once "define.php";
require_once "function.php";

if(yayin=="pasif"){
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}
else{
    error_reporting(0);
}


config("router");
config("database");
config("app");

use system\core\router;
router::run();
