<?php


namespace system\core;


class face
{

    public function __construct()
    {
        $this->alias();
    }

    public function alias()
    {
        $app = config("services");
        foreach ($app['aliases'] as $key => $value) {
            if (!class_exists($value)) {
                class_alias($value, $key);
             }

        }
    }

}