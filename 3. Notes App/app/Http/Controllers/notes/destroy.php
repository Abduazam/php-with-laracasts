<?php

use app\App;
use app\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

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