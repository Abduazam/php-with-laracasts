<?php

$config = require('config/database.php');

require 'helpers/functions.php';
require 'database/Database.php';
// require 'routes.php';

$id = $_GET['id'];

$sql = "select * from post where id = :id";

$db = new Database($config['mysql'], 'root', 'mysql');
$posts = $db->query($sql, [':id' => $id])->fetch();

dd($posts);