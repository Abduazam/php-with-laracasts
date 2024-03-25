<?php

use app\Response;
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

function view($path, $attributes = []): void
{
    extract($attributes);

    require base_path('views/' . $path);
}

function login($user): void
{
    $_SESSION['user'] = [
        'name' => $user['name'],
        'email' => $user['email'],
    ];

    session_regenerate_id(true);
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
}