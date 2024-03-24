<?php

use app\Router;

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

$router->route($url, $method);