<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午6:07
 */

function isPopOrder($pushOrder, $popOrder){
    if(count($pushOrder) != count($popOrder))
        return false;
    $stack = new SplStack();
    $count = count($pushOrder);

    for($i = 0, $j = 0; $i < $count; $i++){
        $stack->push($pushOrder[$i]);
        while(!$stack->isEmpty() && $stack->top() == $popOrder[$j] && $j < $count){
            $stack->pop();
            $j++;
        }
    }
    return $stack->isEmpty();
}

echo var_export(isPopOrder([1,2,3,4,5],[4,3,5,1,2]),true);
