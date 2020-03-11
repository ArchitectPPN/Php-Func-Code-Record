<?php
function yieldTest()
{
	$id = 2;
	$id = yield $id;
	echo $id;
}

$yieldTest = yieldTest();
$yieldTest->send($yieldTest->current() + 3);