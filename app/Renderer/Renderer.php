<?php

use Lib\DI\Service;

class Renderer
{
    public function render($view, $params = array())
    {
        $config = Service::get('app')->config;

        $controller = strtolower($config['controller']);
        $dir = preg_replace('/\w+$/', '', __DIR__);
        $viewPath = $dir . '../src/views/' . $controller . '/' . $view;
        $layoutPath = $dir . 'views/layout/' . $config['layout'];

        $content = $this->extract($viewPath, $params);

        return $this->extract($layoutPath, [
            'content' => $content,
            'title' => $params['title']
        ]);
    }

    protected function extract($viewPath, $params)
    {
        ob_start();
        extract($params);
        include($viewPath);
        return ob_get_clean();
    }
}
