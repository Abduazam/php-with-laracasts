<?php

require base_path('contracts/Validator.php');

$config = require base_path('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (Validator::required($_POST['body'])) {
		$errors['body'] = 'A body is required.';
	}

	if (! Validator::max($_POST['body'], 255)) {
		$errors['body'] = 'The body can not be more than 255 characters.';
	}

	if (empty($errors)) {
		$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
			'body' => $_POST['body'],
			'user_id' => 1
		]);
	}
}

view('/notes/create.view.php', [
	'heading' => 'Create a Note',
	'errors' => $errors
]);
