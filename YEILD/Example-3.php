<?php
function readFileFormString( string $sFilePath )
{
	$handle = fopen($sFilePath, 'r');

	try{
		while (!feof($handle)) {
			yield trim(fgets($handle));
		}
	} finally {
		fclose($handle);
	}
}

// 读取文件
$oFileContent = readFileFormString('../DFA/SensitiveWords_copy.txt');

foreach ($oFileContent as $item => $value){
	echo $item . "---" . $value . PHP_EOL;
}

