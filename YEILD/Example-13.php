<?php
function genTest()
{
	yield 1;
	return 2;
}

foreach(genTest() as $key => $val){
	var_dump(genTest());
	echo "{$key} -- {$val}" . PHP_EOL;
}
