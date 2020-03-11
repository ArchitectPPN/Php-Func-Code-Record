<?php
$arr = [
    1,2,3,4,5
];

$newArr = array_chunk($arr, 1, true);
print_r($newArr);
