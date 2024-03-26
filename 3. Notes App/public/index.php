<?php

session_start();

use app\Exceptions\ValidationException;
use app\Router;
use app\Session;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'helpers/functions.php';

spl_autoload_register(function ($class) {
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

	require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();

require base_path('routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($url, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();