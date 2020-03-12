<?php

function createFile($sFileName, $iLoops = 500)
{
	for($i = 1; $i <= $iLoops; $i++)
	{
		$sStr = '#### Q'. $i . '.' . PHP_EOL . PHP_EOL . PHP_EOL;
		file_put_contents($sFileName, $sStr, FILE_APPEND);
	}

	echo 'success';
}

createFile('./面试题总汇-MySQL.md');
