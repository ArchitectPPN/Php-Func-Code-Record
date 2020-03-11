<?php

function cmp($a ,$b){
    var_dump("a={$a}, b={$b}");

    if($a == $b){
        return 0;
    }

    return ($a < $b) ? -1 : 1;
}

$a = array(3,2,5,6,7,1);

usort($a, 'cmp');
die;
foreach($a as $key => $val){
    echo "{$key}: {$val}\n";
}