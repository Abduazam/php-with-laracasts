<?php

namespace app\Middleware;

use Exception;

class Middleware
{
    public const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class,
    ];

    /**
     * @throws Exception
     */
    public static function resolve($key): void
    {
        if (is_null($key)) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (! $middleware) {
            throw new Exception("No matching middleware for key: {$key}.");
        }

        (new $middleware)->handle();
    }
}