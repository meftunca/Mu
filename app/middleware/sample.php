<?php
/**
 * Created by PhpStorm.
 * User: devloop
 * Date: 07.10.2017
 * Time: 01:49
 */

namespace app\middleware;

use system\libary\session;

class sample
{
    public static function handle()
    {
        if (!@session::has('login')) {
            //return redirect('home');
            exit("giriş yasaklandı :D");
        }
    }

}