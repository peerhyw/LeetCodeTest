<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午10:32
 */

function fibonacci($n){
    if($n < 0)
        return false;
    $fibonacci[0] = 0;
    $fibonacci[1] = 1;
    for ($i = 2; $i <= $n; $i++)
        $fibonacci[$i] = $fibonacci[$i-1] + $fibonacci[$i-2];
    return $fibonacci;
}

var_dump(fibonacci(39));