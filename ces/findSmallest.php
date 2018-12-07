<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午4:47
 */

function findSmallest($arr, $n){
    sort($arr);
    return array_slice($arr, 0, $n);
}

$res = findSmallest([4,5,6,3,2,1,6,7,8,0],8);
print_r($res);