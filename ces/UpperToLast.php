<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-12
 * Time: 下午9:42
 */
function UpperToLast($str){
    $tmpIndex = 0;
    for($i = 0; $i < strlen($str)-$tmpIndex; $i++){
        if($str[$i] >= 'A' && $str[$i] <= 'Z'){
            $temp = $str[$i];
            $tmpIndex++;
            for($j = $i; $j < strlen($str)-1; $j++){
                $str[$j] = $str[$j+1];
            }
            $str[strlen($str)-1] = $temp;
        }
    }
    echo $str;
}

UpperToLast('AkleBiCeilD');