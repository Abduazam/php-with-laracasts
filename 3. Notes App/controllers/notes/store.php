<?php

use app\App;
use app\Database;
use app\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (Validator::required($_POST['body'])) {
    $errors['body'] = 'A body is required.';
}

if (! Validator::max($_POST['body'], 255)) {
    $errors['body'] = 'The body can not be more than 255 characters.';
}

if (! empty($errors)) {
    view('/notes/create.view.php', [
        'heading' => 'Create a Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('location: /notes');
die();

