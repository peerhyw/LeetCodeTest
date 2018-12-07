<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午12:21
 */

//与运算是关键
function numberOfOne($n){
    $count = 0;
    if($n < 0){
        $n = $n & 0X7FFFFFFF;
        $count++;
    }
    while($n){
        $n = ($n - 1) & $n;
        $count++;
    }
    return $count;
}

echo numberOfOne(10);