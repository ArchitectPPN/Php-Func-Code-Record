<?php
# 用给定的值填充数组
# array_fill() 用 value 参数的值将一个数组填充 num 个条目，键名由 start_index 参数指定的开始。
# 如果 start_index 是负数， 那么返回的数组的第一个索引将会是 start_index ，而后面索引则从0开始。

$aArray = array_fill(-2, 5, 'p');

$aArray = array_fill(3, 5, 'p');

var_dump($aArray);
/**
 * array(5) {
 * 		[-2]=>
 * 		string(1) "p"
 * 		[0]=>
 * 		string(1) "p"
 * 		[1]=>
 * 		string(1) "p"
 * 		[2]=>
 * 		string(1) "p"
 * 		[3]=>
 * 		string(1) "p"
 * }
 */
