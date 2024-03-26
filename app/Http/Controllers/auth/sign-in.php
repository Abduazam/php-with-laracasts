<?php

use app\Authenticator;
use app\Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'password', 'No matching account found for that email address and password.'
    )->throw();
}

redirect('/');



