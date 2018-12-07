<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-23
 * Time: 下午6:32
 */


function generate(){
    $cap = [];
    for($i = 0; $i <= 25; $i++){
        $cap[$i] = chr(97 + $i);
    }
    return $cap;
}

function numToCap($num, &$res, $temp = [], $index = 0){
    $numStr = strval($num);
    if($index == strlen($numStr)){
        $res[] = $temp;
    }else{
        if ($numStr[$index] != null){
            $temp[] = $numStr[$index];
            numToCap($num,$res,$temp,$index+1);
        }
        if($numStr[$index] != null && $index < strlen($numStr)-1 ){
            array_pop($temp);
            if(intval($numStr[$index].$numStr[$index+1]) <= 25){
                $temp[] = $numStr[$index].$numStr[$index+1];
                numToCap($num,$res,$temp,$index+2);
            }
        }
    }
}

function change(&$res){
    $trans = generate();
    for ($i = 0; $i < count($res); $i++){
        $str = '';
        for($j = 0; $j < count($res[$i]); $j++){
            $str .= $trans[$res[$i][$j]];
        }
        $res[$i] = $str;
    }
}

$res = [];
numToCap(12258,$res);
print_r($res);
change($res);
print_r($res);