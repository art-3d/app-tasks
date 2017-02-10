<?php

namespace App\DI;

class Service
{
    private static $objects = [];

    public static function set($name, $object)
    {
        self::$objects[$name] = $object;
    }

    public static function get($name)
    {
        return isset(self::$objects[$name]) ? self::$objects[$name] : null;
    }
}