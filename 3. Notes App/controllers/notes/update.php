<?php

use app\App;
use app\Database;
use app\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    ':id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (Validator::required($_POST['body'])) {
    $errors['body'] = 'A body is required.';
}

if (! Validator::max($_POST['body'], 255)) {
    $errors['body'] = 'The body can not be more than 255 characters.';
}

if (! empty($errors)) {
    view('/notes/edit.view.php', [
        'heading' => 'Edit Note',
        'note' => $note,
        'errors' => $errors
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

header('location: /notes');
die();

