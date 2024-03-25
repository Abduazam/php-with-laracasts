<?php

use app\App;
use app\Database;
use app\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::required($email)) {
    if (! Validator::email($email)) {
        $errors['email'] = 'Please provide a valid email address.';
    }
} else {
    $errors['email'] = 'Email is required.';
}

if (! Validator::required($password)) {
    if (! Validator::min($password, 3)) {
        $errors['password'] = 'Password should be greater than 3 characters.';
    }

    if (! Validator::max($password, 16)) {
        $errors['password'] = 'Password should be less than 16 characters.';
    }
} else {
    $errors['password'] = 'Password is required.';
}

if (! empty($errors)) {
    view('auth/login.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login($user);

        header('location: /');
        exit();
    }
}

view('auth/login.view.php', [
    'errors' => [
        'password' => 'No matching account found for that email address and password.'
    ]
]);



