<?php

namespace Oliv\app;

class Autoload
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoloader']);
    }

    public static function autoloader($className)
    {
        $className = str_replace(__NAMESPACE__ . '\\', '', $className);
        require (__DIR__ . '/' . $className . '.php');
    }
}