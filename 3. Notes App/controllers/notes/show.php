<?php

use app\Database;

$config = require base_path('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['id'];

    $note = $db->query('select * from notes where id = :id', [
        ':id' => $postId
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('delete from notes where id = :id', [
        ':id' => $postId
    ]);

    header('location: /notes');
    exit();
} else {
    $note = $db->query('select * from notes where id = :id', [
        ':id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    view('/notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note
    ]);
}
