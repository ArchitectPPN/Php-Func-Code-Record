<?php
class App {
        protected $status = '200';
        protected $object = [];

    /**
     * @param $name
     * @param $callBack 匿名函数
     * @return mixed
     */
        public function bindObject($name, $callBack)
        {
            // 绑定
            return $this->object[$name] = $callBack->bindTo($this, __CLASS__);
        }

        public function dispatch($name)
        {
            foreach ($this->object as $index => $closure) {
                if($name === $index){
                    echo $closure($name);
                }
            }
        }
}

$app = new App();
$app->bindObject('architectPPN', function($name){
    $this->status = $name;
    return $this->status . "\n";
});

$app->dispatch('architectPPN');

$app->bindObject('NG', function ($name){
    $this->status = $name;
    echo $this->status;
});

$app->dispatch('NG');