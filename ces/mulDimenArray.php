<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-6
 * Time: 下午8:49
 */
function travel($value){
    if(is_array($value)){
        echo "[";
        array_map("travel",$value);
        echo "]";
    }else{
        echo $value."\t";
    }
}


$arr = [[1,[2,3],4,5,[6,7,[8,9,0]]]];
travel($arr);