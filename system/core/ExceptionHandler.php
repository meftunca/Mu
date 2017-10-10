<?php


namespace system\core;
use Exception;
class ExceptionHandler
{
    public function __construct($title, $body)
    {
        throw new Exception(strip_tags($title . ': ' . $body), 1);
    }
}