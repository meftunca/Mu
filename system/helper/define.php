<?php

/**
 * @devloop mvc enginer
 *
 * sistem haritası
 */

// ön tanımlılar

define("VERSION","V~0.1");


define("base",implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)));

define("root","");

//anadizin dosyaları
define("system",root."system/");
define("app",root."app/");
define("config","config/");


//system
define("core",system."core/");
define("libary",system."libary/");
define("helper",system."helper/");


//app dosyaları
define("middleware",app."middleware/");
define("controller",app."controller/");
define("model",app."model/");
define("view",app."view/");
define("storage",app."storage/");

/**
 * sistem özellikleri
 */
define("yayin","pasif");//site yayındaysa aktif değilse pasif olarak işaretleyin

date_default_timezone_set('Europe/Istanbul');
