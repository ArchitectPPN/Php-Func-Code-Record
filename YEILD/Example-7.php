<?php
function getLines(string $sFilePath){
	try{
		$f = fopen($sFilePath, 'r');
		while($line = fgets($f)){
			yield $line;
		}
	} catch(Exception $e) {
		return $e->getMessage();
	} finally {
		fclose($f);
	}
}

foreach(getLines("../example.txt") as $n => $lines){
	echo "$lines";
}