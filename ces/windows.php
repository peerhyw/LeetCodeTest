<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-27
 * Time: 下午3:59
 */

function myMax($arr,$offset,$length = 0){
    $count  = count($arr);
    if($offset > $count - 1)
        return false;
    if($length < 0){
        $length = $count - abs($length);
    }
    if($length == 0){
        $length = $count - $offset;
    }
    $max = $arr[$offset];
    for($i = $offset + 1; $i < $offset + $length; $i++){
        if($arr[$i] > $max){
            $max = $arr[$i];
        }
    }
    return $max;
}

function windowsMax($arr,$winLength){
    $count = count($arr);
    $windowsMax = [];
    $max = myMax($arr,0,$winLength);
    $windowsMax[] = $max;
    for($i = $winLength; $i < $count; $i++){
        if($arr[$i] > $max){
            $max = $arr[$i];
        }else{
            if($arr[$i - $winLength] == $max){
                $max = myMax($arr,$i - $winLength + 1,$winLength);
            }
        }
        $windowsMax[] = $max;
    }
    return $windowsMax;
}

//echo myMax([2,3,4,2,6,2,5,1],0).PHP_EOL;

$windowsMax = windowsMax([2,3,4,2,6,2,5,1],3);
print_r($windowsMax);