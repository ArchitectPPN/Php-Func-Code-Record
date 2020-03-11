<?php
function Gen()
{
	while (TRUE) {
			yield "Gen\n";
	}
}

$gen = Gen();

# $gen 是否是 Iterator 的对象
var_dump($gen instanceof Iterator);

echo "Hello World~";

# 这里会陷入死循环
foreach ($gen as $key => $val){
	echo $key . "---" . $val;
}