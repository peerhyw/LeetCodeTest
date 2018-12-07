<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午5:51
 */

class myStack {
    private $stack;

    public function __construct() {
        $this->stack = [];
    }

    public function push($value) {
        $this->stack[] = $value;
    }

    public function pop() {
        $pop = $this->stack[count($this->stack)-1];
        unset($this->stack[count($this->stack)-1]);
        return $pop;
    }

    public function min() {
        $min = $this->stack[0];
        for($i = 0; $i < count($this->stack); $i++){
            if($this->stack[$i] < $min)
                $min = $this->stack[$i];
        }
        return $min;
    }
}

$stack = new myStack();
$stack->push(3);
$stack->push(2);
$stack->push(4);
$stack->push(1);
$stack->push(5);

echo "pop: ".$stack->pop()."\n";
echo "min: ".$stack->min()."\n";
echo "pop: ".$stack->pop()."\n";
echo "min: ".$stack->min()."\n";
