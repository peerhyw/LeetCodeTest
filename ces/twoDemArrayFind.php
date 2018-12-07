<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 上午3:17
 */

function twoDemArrayFind($arr, $needle){
    foreach ($arr as $key => $value){
        print_r($value);
        if(in_array($needle, $value)){
            return true;
        }
    }
    return false;
}

$arr = [[1,2,3],[4,5],[7,8,9]];
if (twoDemArrayFind($arr, 0))
    echo "Y";
else
    echo "N";