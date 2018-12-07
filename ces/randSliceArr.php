<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-13
 * Time: 下午7:32
 */

function randSliceArr($arr){
    $count = count($arr);
    $sliceIndex = random_int(1,$count);
    echo "si: ".$sliceIndex."\n";
    $left = array_slice($arr,0,$sliceIndex);
    $right = array_diff_assoc($arr,$left);
    return $arr = array_merge($right,$left);
}

$arr = [1,2,3,4,5,6,7,8,9,0,'a'];
$arr = randSliceArr($arr);
print_r($arr);