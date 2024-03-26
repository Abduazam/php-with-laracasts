<?php

namespace app\Middleware;

class Guest
{
    public function handle(): void
    {
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}