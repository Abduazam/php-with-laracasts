<?php

use app\App;
use app\Database;
use app\Http\Forms\RegisterForm;
use app\Validator;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$form = new RegisterForm();

if (! $form->validate($name, $email, $password)) {
    view('auth/register.view.php', [
        'errors' => $form->errors()
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    view('auth/register.view.php', [
        'errors' => [
            'email' => 'Email already exists.'
        ]
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