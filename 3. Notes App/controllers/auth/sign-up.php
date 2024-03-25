<?php

use app\App;
use app\Database;
use app\Validator;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::required($name)) {
    if (! Validator::min($name, 3)) {
        $errors['name'] = 'Name should be greater than 3 characters.';
    }
} else {
    $errors['name'] = 'Name is required.';
}

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
    view('auth/register.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    $errors['email'] = 'Email already exists.';

    view('auth/register.view.php', [
        'errors' => $errors
    ]);
} else {
    $db->query('insert into users(name, email, password) values (:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login([
        'name' => $name,
        'email' => $email,
    ]);

    header('location: /');
    exit();
}