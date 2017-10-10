<?php

use system\core\router;

router::get('/', 'deneme@index');
router::get('/admin', 'deneme@index',["middleware"=>["sample"]]);

