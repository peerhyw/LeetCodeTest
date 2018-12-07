<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午6:49
 */

function countTimes($arr, $value){
    $res = array_count_values($arr);
    if(in_array($value,$arr))
        return $res[$value];
    return 0;
}

echo countTimes([1,2,3,3,3,3,4,5], 3);