<?php

$router->get('/', 'controllers/home.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

$router->get('/notes/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

$router->get('/notes/create', 'controllers/notes/create.php');
$router->post('/note', 'controllers/notes/store.php');

$router->get('/register', 'controllers/auth/register.php')->only('guest');
$router->post('/register', 'controllers/auth/sign-up.php')->only('guest');

$router->get('/login', 'controllers/auth/login.php')->only('guest');
$router->post('/login', 'controllers/auth/sign-in.php')->only('guest');
$router->delete('/logout', 'controllers/auth/logout.php')->only('auth');
