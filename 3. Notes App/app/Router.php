<?php

namespace app;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    protected function add($uri, $method, $controller): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller
        ];
    }

    public function get($uri, $controller): void
    {
        $this->add($uri, 'GET', $controller);
    }

    public function post($uri, $controller): void
    {
        $this->add($uri, 'POST', $controller);
    }

    public function put($uri, $controller): void
    {
        $this->add($uri, 'PUT', $controller);
    }

    public function patch($uri, $controller): void
    {
        $this->add($uri, 'PATCH', $controller);
    }

    public function delete($uri, $controller): void
    {
        $this->add($uri, 'DELETE', $controller);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    #[NoReturn]
    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("views/errors/{$code}.view.php");

        die();
    }
}