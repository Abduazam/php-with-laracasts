<?php

use app\Authenticator;

$auth = new Authenticator();
$auth->logout();

redirect('/');