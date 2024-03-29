<?php

use app\Response;
use app\Session;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($url): bool
{
    return $_SERVER['REQUEST_URI'] === $url;
}

#[NoReturn]
function abort($code = 404): void
{
    http_response_code($code);

    require view("errors/{$code}.view.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    return require base_path('views/' . $path);
}

#[NoReturn]
function redirect($path): void
{
    header("location: {$path}");
    exit();
}

function old($key, $default = ''): string
{
    return Session::get('old')[$key] ?? $default;
}