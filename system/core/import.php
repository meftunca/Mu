<?php


namespace system\core;



class import
{

    /**
     * Include view file
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    public function get($file, $key = null, $val = null)
    {
        $config =  config($file);
        if (is_null($key)) {
            return $config;
        } else {
            if (is_null($val)) {
                return $config[$key];
            } else {
                return $config[$key][$val];
            }
        }
    }
    public function view($file, $data = [])
    {
        $filePath = view . $file . '.php';
        if (file_exists($filePath)) {
            extract($data);
            require_once $filePath;
        }

    }
    /**
     * Include helper file
     *
     * @param string $file
     * @return void
     */
    public function helper($file)
    {
        $filePath = app . 'helper/' . $file . '.php';
        if (file_exists($filePath))
            require_once $filePath;

    }

    public static function model($file, $namespace = null)
    {
        if (is_null($namespace)) {
            $filePath 	= "app/model/" . $file . '.php';
            $class 		= 'app\\model\\' . $file;
        } else {
            $filePath 	= "app/model/" . $namespace . '/' . $file . '.php';
            $class 		= 'app\\model\\' . $namespace . '\\' . $file;
        }
        if (file_exists($filePath)) {
            require_once $filePath;
            return new $class;
        }
    }
    /**
     * Include custom file
     *
     * @param string $file
     * @return mixed
     */
    public static function file($file)
    {
        if (file_exists($file . '.php'))
            return require $file . '.php';

    }
    /**
     * Include config file
     *
     * @param string $file
     * @return mixed
     */
    public static function config($file)
    {
        if (file_exists(app . 'config/' . $file . '.php'))
            return require app . 'config/' . $file . '.php';

    }
}