<?php
class app{
    public $a;
}

class app2{
    public $a;
}

$app  = new app();
$app2 = new app2();
$id   = spl_object_id($app);
$id2  = spl_object_id($app2);
var_dump($id, $id2);
$spl[$id] = $app;
$spl[$id2] = $app2;
var_dump($spl);
