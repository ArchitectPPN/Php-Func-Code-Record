<?php
function &gen_refrence()
{
	$val = 3;
	
	while($val > 0) {
		yield $val;
	}
}

foreach(gen_refrence() as &$number)
{
	echo (--$number) . '...';
}

