<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午5:39
 */

function findOneFromOneToN($n){
    $res = [];
    for($i = 1; $i <= $n; $i++){
        $intToStr = strval($i);
        if(false !== strpos($intToStr,'1'))
            $res[] = $i;
    }
    return $res;
}

$res = findOneFromOneToN(100);
print_r($res);