<?php

$config = require base_path('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    ':id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('/notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);