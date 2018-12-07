<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 上午1:58
 */

function firstOnlyOne($arr){
    $res = array_count_values($arr);
    print_r($res);
    $value = array_search(1, $res);
    return $value;
}

$arr = ['a','a','a','b','c','d','b','e','d','c','f','e'];
echo firstOnlyOne($arr);