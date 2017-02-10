<?php

namespace App\Response;

class Response
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        header('HTTP/1.1 200 Ok');
        echo $this->content;
    }
}
