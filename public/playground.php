<?php

use Illuminate\Support\Collection;

require __DIR__ . '/../vendor/autoload.php';

$numbers = new Collection([1,2,3,4,5,6,7,8]);

if ($numbers->contains(5)) {
    var_dump('it contains 5');
}