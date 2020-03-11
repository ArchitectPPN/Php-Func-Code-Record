<?php
function xRange(int $iStart, int $iEnd, int $iStep = 1)
{	
	for($i = $iStart; $i <= $iEnd; $i += $iStep){
		yield $i;
	}
}
	
foreach(xRange(1, 1000) as $num){
	echo $num, "\n";	// 生成大数组
}
