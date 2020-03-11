<?php
function foo() {
	$string = yield;
    echo $string;
    for ($i = 1; $i <= 3; $i++) {
        yield $i;
		
    }
}

$generator = foo();
#$generator->send('Hello world!');
foreach ($generator as $value) {
	#$generator->send('Hello world!');
	echo "$value\n";
}
