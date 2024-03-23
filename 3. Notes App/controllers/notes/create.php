<?php

require 'contracts/Validator.php';

$heading = "Create a Note";

$config = require('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$errors = [];

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

require 'views/notes/create.view.php';