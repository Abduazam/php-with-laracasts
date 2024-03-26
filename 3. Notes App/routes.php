<?php

$router->get('/', 'home.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');

$router->get('/notes/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');

$router->get('/notes/create', 'notes/create.php');
$router->post('/note', 'notes/store.php');

$router->get('/register', 'auth/register.php')->only('guest');
$router->post('/register', 'auth/sign-up.php')->only('guest');

$router->get('/login', 'auth/login.php')->only('guest');
$router->post('/login', 'auth/sign-in.php')->only('guest');
$router->delete('/logout', 'auth/logout.php')->only('auth');
