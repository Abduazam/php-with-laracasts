<?php

use app\App;
use app\Container;
use app\Database;

$container = new Container();

$container->bind('app\Database', function () {
    $config = require base_path('config/database.php');

    return new Database($config['mysql'], 'root', 'root');
});

App::setContainer($container);