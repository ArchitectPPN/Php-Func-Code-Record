<?php
$arr =[
    'ok',
    'bug',
    'fix'
];

// 更改$a的值
$a = [];
array_walk($arr, function($key, $val) use (&$a){
    $a[$val.$key] = $key;
});
var_dump($a);

function myFunc($val, $key, $p){
    echo $val . "---" . $key . "---" . $p . "\n";
}

array_walk($arr, 'myFunc', 'PPN');




# 更改一个元素的值
function myfunction(&$value,&$key, $num)
{
    $value="yellow" . $num;
}
$a=array(1=>"red",2=>"green",3=>"blue");
array_walk($a,"myfunction", 23);
print_r($a);