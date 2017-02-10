<?php

namespace App\Session;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set($name, $val)
    {
        $_SESSION[$name] = $val;
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public function delete($name)
    {
        unset($_SESSION[$name]);
    }
}
