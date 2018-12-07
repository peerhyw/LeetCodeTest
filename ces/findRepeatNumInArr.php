<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-24
 * Time: 上午1:16
 */

function findRepeat($arr){
    $tmp = array_count_values($arr);
    $res = [];
    foreach ($tmp as $key => $count){
        if($count > 1)
            $res[] = $key;
    }
    return $res;
}

$res = findRepeat([1,2,2,2,3,4,4,4,5,6,6]);
print_r($res);