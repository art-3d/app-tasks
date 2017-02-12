<?php

namespace App\Renderer;

use App\DI\Service;

class Renderer
{
    public static function render($view, $params = array())
    {
        $config = Service::get('app')->config;

        $controller = self::getControllerName($config['controller']);
        $dir = preg_replace('/\w+$/', '', __DIR__);
        $viewPath = $dir . '../src/views/' . $controller . '/' . $view;
        $layoutPath = $dir . '../src/views/layout/' . $config['layout'];

        $content = self::extract($viewPath, $params);

        return self::extract($layoutPath, [
            'content' => $content,
            'title' => $params['title']
        ]);
    }

    private static function getControllerName($path)
    {
        $matches = [];
        preg_match('/(\w+)Controller$/', $path, $matches);
        return strtolower($matches[1]);
    }

    private static function extract($viewPath, $params)
    {
        if (! file_exists($viewPath)) {
            echo $viewPath;die;
        }
        ob_start();
        extract($params);
        include($viewPath);
        return ob_get_clean();
    }
}
