<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午6:23
 */

/*
function smallestArrange($arr){
    $res = [];
    $str = '';
    for($i = 0; $i < count($arr); $i++){
        if($arr[$i] < 0)
            return false;
        $str .= $arr[$i];
    }
    $res[0] = intval($str);
    for($i = 0; $i < count($arr); $i++){
        $temp = $arr[$i];
        echo "temp: $temp\n";
        for($j = 0; $j < count($arr); $j++){
            $tmpArr = $arr;
            if($j == $i)
                continue;
            if($j < $i){
                echo "here <:\n";
                for ($k = $i; $k > $j; $k--){
                    $tmpArr[$k] = $tmpArr[$k-1];
                }
                $tmpArr[$j] = $temp;
                print_r($tmpArr);
                $res[] = $tmpArr;
            }else{
                echo "here >:\n";
                for($k = $i; $k < $j; $k++){
                    $tmpArr[$k] = $tmpArr[$k+1];
                }
                $tmpArr[$j] = $temp;
                print_r($tmpArr);
                $res[] = $tmpArr;
            }
        }
    }
    for($i = 1; $i < count($res); $i++){
        $str = strval($res[$i][0]);
        for($j = 1; $j < count($res[$i]); $j++){
            $str.=strval($res[$i][$j]);
        }
        $int = intval($str);
        $res[$i] = $int;
    }
    print_r($res);
    return min($res);
}
*/

function smallestArrange($arr){
    $res = [];
    recur(0,$arr,$res);
    //$res = array_unique($res);
    for($i = 0; $i < count($res); $i++){
        $intToStr = '';
        for($j = 0; $j < count($res[$i]); $j++){
            $intToStr .= strval($res[$i][$j]);
        }
        $res[$i] = intval($intToStr);
    }
    return min($res);
}

function recur($step, &$arr, &$res){
    if($step == count($arr)-1){
        $res[] = $arr;
    }
    for($i = $step; $i < count($arr); $i++){
        $temp = $arr[$step];
        $arr[$step] = $arr[$i];
        $arr[$i] = $temp;
        recur($step+1,$arr,$res);
        $temp = $arr[$step];
        $arr[$step] = $arr[$i];
        $arr[$i] = $temp;
    }
}

$res = smallestArrange([3,32,321]);
print_r($res);