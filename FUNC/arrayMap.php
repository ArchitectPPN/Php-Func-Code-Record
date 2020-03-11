<?php
//$name  = ['源氏', '死神'];
//$skill = ['神龙之剑', '死亡绽放'];
//
//$heroDes = array_map(function($name, $skill){
//    return "name:{$name}, skill:{$skill}";
//}, $name, $skill);
//
//$money = [1,2,3,4,5];
//$newMoney = array_map(function($money) {
//    if($money > 3){
//        return $money;
//    }
//} , $money);
//
//print_r(array_filter($newMoney));
$arr = [
    [1, NULL, 2, NULL]
];
$arrs = array_map(function($arr){
    if(is_array($arr)){
        return array_filter($arr);
    }
}, $arr);

var_dump($arrs);
