<?php

namespace app;

use app\Middleware\Middleware;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    protected function add($uri, $method, $controller): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller,
            'middleware' => null,
        ];

        return $this;
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function get($uri, $controller): static
    {
        return $this->add($uri, 'GET', $controller);
    }

    public function post($uri, $controller): static
    {
        return $this->add($uri, 'POST', $controller);
    }

    public function put($uri, $controller): static
    {
        return $this->add($uri, 'PUT', $controller);
    }

    public function patch($uri, $controller): static
    {
        return $this->add($uri, 'PATCH', $controller);
    }

    public function delete($uri, $controller): static
    {
        return $this->add($uri, 'DELETE', $controller);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path('app/Http/Controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    #[NoReturn]
    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("views/errors/{$code}.view.php");

        die();
    }
}