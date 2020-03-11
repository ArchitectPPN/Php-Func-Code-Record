<?php
$generator = function($iX, $iY){
	try {
		yield $iX * $iY;
	} catch (InvalidArgumentException $exception) {
		print "Error";
	}
};



$calculate = function ($sOp, $iX, $iY) use ($generator) {
	if($sOp === 'multiply'){
		$generator = $generator($iX, $iY);

		if(!is_numeric($iX) || !is_numeric($iY)){
			$generator->throw(new InvalidArgumentException());
		}

		return $generator->current();
	}
};

print $calculate('multiply', 5, 'foo');