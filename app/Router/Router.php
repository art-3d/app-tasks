<?php

namespace App\Router;

use App\DI\Service;

class Router
{
    public static function parseURI($uri)
    {
        $params = [];
        $uri = preg_replace('/\?.+$/', '', $uri);
        $uriChunks = explode('/', $uri);
        array_shift($uriChunks);
        $config = Service::get('app')->config;

        $controller = $config['defaultController'];

        if ($uri == '/') {
            $action = $config['defaultAction'];
        } elseif (count($uriChunks) == 1) {
            $action = array_shift($uriChunks);
        } elseif (count($uriChunks) > 1) {
            $action = array_shift($uriChunks);
            $params = $uriChunks;
        } else {
            throw new \Exception('Route does not found.');
        }

        return [
            'controller' => $controller,
            'action' => $action,
            'params' => $params
        ];
    }
}
