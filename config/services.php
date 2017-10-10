<?php

return [
    /**
     * Service Providers
     */
    'providers' => [
        \system\core\import::class,
        \system\core\model::class,
        \system\core\view::class,
        \system\core\database::class,
        \system\core\router::class,
        \system\core\ExceptionHandler::class,
        \system\core\face::class,
        \system\libary\form::class,
        \system\libary\html::class,
        \system\libary\request::class,
        \system\libary\userAgent::class,
        \system\libary\validation::class,
        \system\libary\csrf::class,
        \system\libary\cache::class,
        \system\libary\pagination::class,
        \system\libary\cookie::class,
        \system\libary\response::class,
        \system\libary\session::class,
        \system\libary\console::class,
        \system\libary\log::class,
        \system\libary\event::class,
        \Windwalker\Edge\Loader\EdgeFileLoader::class,
        //composer app

    ],
    'aliases' => [
        "import" => \system\core\import::class,
        "model" => \system\core\model::class,
        "view" => \system\core\view::class,
        "db" => \system\core\database::class,
        "router" => \system\core\router::class,
        "face" => \system\core\face::class,
        "ExceptionHandler" => \system\core\ExceptionHandler::class,
        "form" => \system\libary\form::class,
        "html" => \system\libary\html::class,
        "request" => \system\libary\request::class,
        "userAgent" => \system\libary\userAgent::class,
        "validation" => \system\libary\validation::class,
        "csrf" => \system\libary\csrf::class,
        "cache" => \system\libary\cache::class,
        "pagination" => \system\libary\pagination::class,
        "cookie" => \system\libary\cookie::class,
        "response" => \system\libary\response::class,
        "session" => \system\libary\session::class,
        "console" => \system\libary\console::class,
        "log" => \system\libary\log::class,
        "event" => \system\libary\event::class,
        "edge" => \Windwalker\Edge\Loader\EdgeFileLoader::class,

        //composer app

    ],
    /**
     * Middlewares
     */
    'middleware' => [
        'sample' => 'app\middleware\sample',
    ],

];