<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'helpers/functions.php';

spl_autoload_register(function ($class) {
	require base_path("app/{$class}.php");
});

require base_path('routes.php');