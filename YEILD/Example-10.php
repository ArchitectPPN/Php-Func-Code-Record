<?php
function forLoop()
{
	for($i = 1; $i <= 5; $i++)
	{
		$cmd = (yield $i);
		echo "NOW" . $i . PHP_EOL;
		
		var_dump($cmd);
		echo '--' . $cmd . PHP_EOL;
	}
}

$gen = forLoop();
foreach($gen as $v){
	if($v == 3){
		$gen->send($v+1);
	}
	
	echo "KKK{$v}\n";
	echo PHP_EOL;
}

