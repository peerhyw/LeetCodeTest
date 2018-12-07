<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午8:55
 */

function findTowSumEqlValue($arr, $value){
    $i = 0;
    $j = count($arr) - 1;
    $res = [];
    while($i < $j){
        if($arr[$i] + $arr[$j] < $value){
            $i++;
        }elseif($arr[$i] + $arr[$j] > $value){
            $j--;
        }else{
            return [$arr[$i],$arr[$j]];
        }

    }
    return 0;
}

$res = findSumValue([1,2,4,7,11,15],15);
print_r($res);