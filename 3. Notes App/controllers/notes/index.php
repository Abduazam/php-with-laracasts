<?php

$config = require base_path('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

$notes = $db->query('select * from notes where user_id = 1')->get();

view('/notes/index.view.php', [
	'heading' => 'My Notes',
	'notes' => $notes
]);