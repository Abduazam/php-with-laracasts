<?php

use app\Authenticator;
use app\Http\Forms\RegisterForm;

$form = RegisterForm::validate($attributes = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);

$registered = (new Authenticator)->register(
    $attributes['name'], $attributes['email'], $attributes['password']
);

if (!$registered) {
    $form->error(
        'email', 'Email already exists.'
    )->throw();
}

redirect('/');
