<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午5:23
 */

function findGreatestSumOfSubArr($arr){
    $max = $arr[0];
    for($i = 0; $i < count($arr); $i++){
        $sum = 0;
        for($j = $i; $j < count($arr); $j++){
            $sum += $arr[$j];
            if($sum > $max)
                $max = $sum;
        }
    }
    return $max;
}

echo findGreatestSumOfSubArr([6,-3,-2,7,-15,17,2,2]);