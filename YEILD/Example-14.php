<?php
$generator = call_user_func(function() {
	$input = (yield "foo");

	print "inside: " . $input . "\n";
});

$generator->send("bar");

print $generator->current() . "\n";


