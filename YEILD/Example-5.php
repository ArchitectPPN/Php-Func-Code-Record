<?php
function yieldTest()
{
	echo "开始执行\n";
	yield 2;
	yield 3;
	yield 4;
	yield 5;
	echo "结束~";
}

$yieldTest = yieldTest();

foreach ($yieldTest as $item => $value){
	echo $item . "-" . $value . PHP_EOL;
}

