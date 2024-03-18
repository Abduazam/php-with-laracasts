<?php
// EXAMPLE  1
//$cars = [
//    [
//        'brand' => "Chevrolet",
//        'model' => "Malibu",
//        'price' => "24000",
//    ],
//    [
//        'brand' => "Chevrolet",
//        'model' => "Spark",
//        'price' => "10000",
//    ],
//    [
//        'brand' => "BWM",
//        'model' => "X7",
//        'price' => "82000",
//    ],
//    [
//        'brand' => "BWM",
//        'model' => "530i Sedan",
//        'price' => "58000",
//    ],
//];

//function filter($items, $fn)
//{
//    $filteredCars = [];
//
//    foreach ($items as $item) {
//        if ($fn($item)) {
//            $filteredCars[] = $item;
//        }
//    }
//
//    return $filteredCars;
//};
//
//$filteredCars = filter($cars, function ($car) {
//    return $car['brand'] === 'Chevrolet';
//});
//
//// EXAMPLE 2
//$greeting = function ($to) {
//    return "Hello " . $to;
//};
//
//$add = function ($a, $b) {
//    return $a + $b;
//};
//
//var_dump($add);
//
//echo $greeting("World");
//
