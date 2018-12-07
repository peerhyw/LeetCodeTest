<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午9:15
 */

class queue{
    public $queue;

    public function __construct() {
        $this->queue = new SplStack();
    }

    public function push($value) {
        if(!is_array($value))
            $value = array($value);
        foreach ($value as $item)
            $this->queue->push($item);
    }

    public function pop(){
        return $this->queue->shift();
    }
}

$queue = new queue();
$queue->push([1,2,3,4,5]);
print_r($queue->pop());
