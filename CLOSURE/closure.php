<?php

//$closure = function($name){
//    return sprintf('Hello %s', $name);
//};
//
//echo $closure('PPN');
//
//
//$numberPlusOne = array_map(function($number){
//    return $number+1;
//}, [1,2,3]);
//
//print_r($numberPlusOne);

$joinCharToArray = array_map(function($number, $key){
    var_dump("number={$number}, key={$key}");

    return "{$key}->{$number}";
}, [1,2,3], ['NG', 'PPN', 'Architect']);

var_dump($joinCharToArray);









