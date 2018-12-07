<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-23
 * Time: 下午6:20
 */

function sum($n){
    $sum = pow($n,2) + $n;
    $sum = $sum >> 1;
    return $sum;
}

echo sum(5);