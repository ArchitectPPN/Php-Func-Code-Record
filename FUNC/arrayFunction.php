<?php
$numArr = ['ok'=>1, 2, 3, 9];
echo array_sum($numArr);

$combinArr = ['ok'=>'hell', 'ok'];

var_dump(array_merge($combinArr, $numArr));
var_dump(array_merge_recursive($numArr, $combinArr));

$arr = ['arr', 'key', 'key'];

var_dump($arr);
var_dump(array_unique($arr));