<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-6
 * Time: 下午11:58
 */
function findRepeat(Array $array){
    $res = [];
    foreach ($array as $item) {
        if(!array_key_exists($item,$res)){
            $res[$item] = 1;
        }else{
            $res[$item]++;
        }
    }
    var_dump($res);
}

$arr = [1,2,3,3,3,'a','a','b'];
findRepeat($arr);