<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 上午2:05
 */

function reversePair($arr){
    $res = [];
    for($i = 0; $i < count($arr); $i++){
        for($j = $i+1; $j < count($arr); $j++){
            if($arr[$i] > $arr[$j])
                $res[] = [$arr[$i],$arr[$j]];
        }
    }
    return $res;
}

$res = reversePair([7,5,8,6,4]);
print_r($res);