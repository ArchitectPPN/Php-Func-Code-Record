<?php
# 去掉数组中的某一部分并用其他值代替它

$input = ['red', 'green', 'blue', 'yellow'];

# 截取掉1个元素, 用1个元素替代
// array_splice($input, 0, 1, 'NG');
/**
 * 输出结果:
 *	array(4) {
		[0]=>
		string(2) "NG"
		[1]=>
		string(5) "green"
		[2]=>
		string(4) "blue"
		[3]=>
		string(6) "yellow"
	}
 *
 **/

# 截取掉1个元素, 用N个元素替代, 从截取的位置插入新的数组, 索引会重新分配
// array_splice($input, 0, 1, ['NG', 'PPN']);
/**
 * array(5) {
 * 		[0]=>
 * 		string(2) "NG"
 * 		[1]=>
 * 		string(3) "PPN"
 * 		[2]=>
 * 		string(5) "green"
 * 		[3]=>
 * 		string(4) "blue"
 * 		[4]=>
 * 		string(6) "yellow"
 * }
 */

# length 为 -1; 如果指定了 length 并且为负值，则移除从 offset 到数组末尾倒数 length 为止中间所有的单元。
// array_splice($input, 1, -1);
/**
 * array(2) {
 * 		[0]=>
 * 		string(3) "red"
 * 		[1]=>
 * 		string(6) "yellow"
 * }
 */

# 如果 offset 为负，则从 input 末尾倒数该值指定的偏移量开始移除
// array_splice($input, -1);
/**
 * 移除了 yellow 元素
 * array(3) {
 * 		[0]=>
 * 		string(3) "red"
 * 		[1]=>
 * 		string(5) "green"
 * 		[2]=>
 * 		string(4) "blue"
 * }
 */

# offset, length 均为负数
// array_splice($input, -1, -4);
/**
 * 均为负数不会移除任何一个元素, 因为offset为 -1 时从末尾倒数第一个位置开始, 也就是yellow, 然后 length 为 -2,中间没有值
 * array(4) {
 * 		[0]=>
 * 		string(3) "red"
 * 		[1]=>
 * 		string(5) "green"
 * 		[2]=>
 * 		string(4) "blue"   -2
 * 		[3]=>
 * 		string(6) "yellow" -1
 * }
 */
# offset, length 均为负数, 且有替换数组
// array_splice($input, -1, -4, ['品牌', 'PP']);
/**
 * 会从-1的位置开始插入
 * array(6) {
 * 		[0]=>
 * 		string(3) "red"
 * 		[1]=>
 * 		string(5) "green"
 * 		[2]=>
 * 		string(4) "blue"
 * 		[3]=>
 * 		string(6) "品牌"
 * 		[4]=>
 * 		string(2) "PP"
 * 		[5]=>
 * 		string(6) "yellow"
 * }
 */

/**
 * 注意:
 * replacement
 * 如果给出了 replacement 数组，则被移除的单元被此数组中的单元替代。
 * 如果 offset 和 length 的组合结果是不会移除任何值，则 replacement 数组中的单元将被插入到 offset 指定的位置。
 * 注意替换数组中的键名不保留。
 * 如果用来替换 replacement 只有一个单元，那么不需要给它加上 array()，除非该单元本身就是一个数组、一个对象或者 NULL。
 */
var_dump($input);