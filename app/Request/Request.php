<?php

namespace App\Request;

class Request
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function post($name)
    {
        return isset($_POST[$name]) ? $this->filter($_POST[$name]) : null;
    }

    public function get($name)
    {
        return isset($_GET[$name]) ? $this->filter($_GET[$name]) : null;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function filter($val)
    {
        $val = trim($val);
        $val = htmlspecialchars($val);
        return $val;
    }
}