<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午10:16
 */

function spin($arr){
    $min = min($arr);
    $index = array_search($min,$arr);
    if($index !== false)
        return array_merge(array_slice($arr,$index),array_slice($arr, 0, $index));
}

$arr = [3,4,5,1,2];
print_r(spin($arr));