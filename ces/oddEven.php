<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午12:47
 */

function oddEven(&$arr){
    $index = 0;
    for($i =  0; $i < count($arr); $i++){
        if($arr[$i] % 2 == 1){
            $temp = $arr[$i];
            for($j = $i; $j > $index; $j--){
                $arr[$j] = $arr[$j-1];
            }
            $arr[$index] = $temp;
            $index++;
            $i++;
        }
    }
}

$arr = [1,2,3,4,5,6,8,7];
oddEven($arr);
print_r($arr);