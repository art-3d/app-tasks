<?php

class Loader
{
    protected static $instance;

    private function __construct()
    {
        spl_autoload_register([$this, 'load']);
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function load($className)
    {
        $classPath = '../' . lcfirst(str_replace('\\', '/', $className)) . '.php';
        include_once($classPath);
    }

    private function __clone()
    {
    }
}

Loader::getInstance();
