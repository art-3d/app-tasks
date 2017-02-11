<?php

namespace App\Controller;

use App\DI\Service;
use App\Response\Response;
use App\Renderer\Renderer;

abstract class Controller
{
    public function render($view, $params = array())
    {
        $content = Renderer::render($view, $params);
        return new Response($content);
    }

    public function redirect($uri)
    {
        header('Location: ' . $uri);
    }
}
