<?php

$heading = 'My Notes';

$config = require('config/database.php');
$db = new Database($config['mysql'], 'root', 'root');

$notes = $db->query('select * from notes where user_id = 1')->get();

require 'views/notes/index.view.php';