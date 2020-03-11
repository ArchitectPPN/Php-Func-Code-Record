<?php
function yieldTest()
{
	echo "Test\n";
	echo (yield 1) . "I\n";
	echo (yield 2) . "II\n";
	echo (yield 3+1) . "III\n";
}

$yieldTest = yieldTest();

foreach ($yieldTest as $item => $value){
	echo "{$item} -- {$value}\n";
}