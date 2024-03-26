<?php

use app\Session;

view('auth/register.view.php', [
    'errors' => Session::get('errors'),
]);