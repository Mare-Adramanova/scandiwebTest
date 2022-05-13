<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $requestMethod, string $route, array $action): Router
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    private function getHomeUrl(){
        return $this->defineProtocol($_SERVER['SERVER_PORT']) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    } 

    private function defineProtocol($port){
        return $port == 80 ? 'http://' : 'https://';
    }

    public function get(string $route, array $action): Router
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, array $action): Router
    {
        return $this->register('post', $route, $action);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @throws \App\RouteNotFoundExeption
     */
    public function resolve($requestUri, $requestMethod)
    {
        return $route = explode('?', $requestUri)[0];
        $action = $this->routes[strtolower($requestMethod)][$route] ?? null;
        
        if (!$action) {
            throw new RouteNotFoundException();
        }

        return [$route, $action];
    }
}
