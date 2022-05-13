<?php

namespace App;

use App\Container\Container;
use ReflectionException;

class Application extends Container
{
    private static DB $db;
    private $router;
    private $request;

    public function __construct(Router $router, array $request, Config $config)
    {
        $this->router = $router;
        $this->request = $request;
        static::$db = new DB($config->db ?? []);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function setRoute($uri, $action)
    {
        $this->routes[$uri] = $action;
        return $this;
    }

    private function prepareRequest($verb){
        return strtolower($verb);
    }

    /**
     * @throws ReflectionException
     * @throws Exceptions\NotFoundException
     */
    public function run()
    {
        $currentUri = $this->router->resolve($this->request['uri'], $this->router->getRoutes()[$this->prepareRequest($this->request['method'])]);
        if(array_key_exists($currentUri, $this->router->getRoutes()[$this->prepareRequest($this->request['method'])])) {
            $action = $this->router->getRoutes()[$this->prepareRequest($this->request['method'])][$currentUri];
        
            if(is_array($action)) {
                $controller = $action[0];
                $method = $action[1];
                $this->register($controller, $controller);
                $instance = $this->get($controller);
                echo $instance->$method();
            } else {
                if(is_callable($action)) {
                    $callbackId = get_class((object)$action) . "_" . uniqid();
                    $this->register($callbackId, $action);
                    echo $this->get($callbackId);
                }
            }
        }
    }
}
