<?php
//    $arr = [5, 2, 1, 4, 3];
//
//    function SelectSort($arr)
//    {
//        $length = count($arr);
//
//        for($i = 0; $i < $length; $i++){
//            // 最小的位置
//            $min = $i;
//            for($j = $i + 1; $j < $length; $j++ ){
//                if($arr[$j] < $arr[$min]){
//                    $min = $j;
//                }
//            }
//
//            if($i != $min){
//                $temp = $arr[$i];
//                $arr[$i] = $arr[$min];
//                $arr[$min] = $temp;
//            }
//        }
//
//        return $arr;
//    }
//
//    function PopSort($arr)
//    {
//        $length = count($arr);
//
//        for($i = 0; $i < $length; $i++){
//            // 0 $j 4
//            for($j = 0; $j < $length - 1; $j++ ){
//                   if($arr[$j] > $arr[$j+1]){
//                        $temp = $arr[$j+1];
//                        $arr[$j+1] = $arr[$j];
//                        $arr[$j] = $temp;
//                   }
//            }
//        }
//        return $arr;
//    }
//
//    $arr = [
//        [
//            'id' => 100,
//            'age' => 20,
//            'birth' => '2019-10-16 17:34:45'
//        ],
//        [
//            'id' => 101,
//            'age' => 21,
//            'birth' => '2019-10-17 17:34:45'
//        ],
//        [
//            'id' => 102,
//            'age' => 22,
//            'birth' => '2019-10-18 17:34:45'
//        ],
//        [
//            'id' => 103,
//            'age' => 23,
//            'birth' => '2019-10-19 17:34:45'
//        ],
//    ];
//
//    $ageArr = array_column($arr, 'id');
//    #var_dump(array_multisort($ageArr, SORT_DESC, $arr));
//    #var_dump($arr);
//
//    $str = 'architect is great~';
//    $newStr = strchr($str, 'architect');
//    echo $newStr;
//
//    // 翻转字符串
//    #$revStr = strrev($str);
//    #echo $revStr;
//
//    $arrPos = strpos($str, 'g');
//    echo $arrPos;
//
//    $endPos = strrpos($str, 'great');
//    echo $endPos;
//
//    $newArr = str_split($str, 3);
//    var_dump($newArr);
//
//    $newStrr = 'Hello World~';
//    $chunkStr = chunk_split($newStrr, 5, 'NG');
//    echo $chunkStr."\n";
//
//
//$a = 0;
//switch ($a){
//    case $a >= 0:
//        echo 1;
//        break;
//
//    case $a >= 10:
//        echo 2;
//        break;
//
//    default:
//        echo 3;
//        break;
//}
//
//if($a = 0 || $b = 0){
//    var_dump($a, $b);
//}
//
//if($a = 100){
//    var_dump($a);
//}
//
//if($a = 100 && 1){
//    var_dump(100 && 1);
//}

echo sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));









