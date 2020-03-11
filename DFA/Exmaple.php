<?php
static $a = [];
$b = &$a;

#var_dump($a, $b);

$a = ['ok'];

#var_dump($a, $b);
$c['ok'] = '11';
$b = ['ok', 'Yes'];

var_dump($b);
$b = &$b['pk'];

var_dump($b);
#$b = &$b['ok'];
#$b ?? $b = FALSE;

var_dump($a, $b);