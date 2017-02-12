<?php

namespace App\Router;

use App\DI\Service;

class Router
{
    protected $map;

    protected $match;

    public function __construct($map)
    {
        $this->map = $map;
    }

    public function getConfig($uri)
    {
        $match = null;

        foreach ($this->map as $route) {
            $requirements = $route['requirements'] ? $route['requirements'] : [];
            $pattern = (count($requirements) > 0) ?
                $this->preparePattern($route['pattern'], $requirements) :
                $route['pattern'];

            if ($requirements['_method'] && Service::get('request')->getMethod() != $requirements['_method']) {
                continue;
            }
            if (preg_match($pattern, $uri)) {
                $match = $route;
                break;
            }
        }
        if (! $match) {
            throw new \Exception('404 Page not found');
        }
        if ($match['requirements']) {
            $match['parameters'] = $this->getParameters($match, $uri);
        }

        return $match;
    }

    private function preparePattern($pattern, $requirements)
    {
        foreach ($requirements as $key => $val) {
            if ($key === '_method') continue;
            $pattern = str_replace('{' . $key . '}', '('.$val.')', $pattern);
        }
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    private function getParameters($matchRoute, $uri)
    {
        if (! $matchRoute['requirements']) return [];
        $matches = [];
        preg_match($this->preparePattern($matchRoute['pattern'], $matchRoute['requirements']), $uri, $matches);

        return array_slice($matches, 1);
    }
}
