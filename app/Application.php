<?php

namespace App;

use App\DI\Service;

class Application
{
    public $config;

    public function __construct($config)
    {
        $this->config = $config;
        $pdoConfig = $config['pdo'];

        Service::set('app', $this);
        Service::set('request', new Request());
        Service::set(
            'pdo',
            new \PDO($pdoConfig['dsn'], $pdoConfig['user'], $pdoConfig['password'], $pdoConfig['opt'])
        );
        Service::set('session', new Session());
    }

    public function run()
    {
        try {
            $route = Router::parseURI($_SERVER['REQUEST_URI']);
            $controller = 'Src\Controller\\' . $route['controller'] . 'Controller';
            $action = $route['action'] . 'Action';
            $params = $route['params'];
            $this->config['controller'] = $route['controller'];
            $controllerReflection = new \ReflectionClass($controller);
            if ($controllerReflection->hasMethod($action)) {
                $reflectionMethod = new \ReflectionMethod($controller, $action);
                $response = $reflectionMethod->invokeArgs(new $controller, $args);
                $response->send();
            } else {
                throw new \Exception('The action "' . $action . '" not found');
            }
        } catch (\Exception $e) {
            Service::get('session')->set('error', $e->getMessage());
            header('Location: /error');
        }
    }
}