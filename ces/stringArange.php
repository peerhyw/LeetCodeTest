<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午3:24
 */
/*
function arrange($str, &$res, $start, $end){
    for ($i = $start; $i <= $end; $i++){
        $temp = $str[$i];
        $tmpStr = str_replace($temp,'',$str);
        echo $tmpStr."\n";
        for($j = 0; $j <= strlen($tmpStr); $j++){
            $preTmp = substr($tmpStr, 0, $j);
            $postTmp = substr($tmpStr, $j);
            $tmpStrRes = $preTmp.$temp.$postTmp;
            echo $tmpStrRes."\n";
            $res[] = $tmpStrRes;
            arrange($tmpStrRes, $res, 0, $j-1);
            arrange($tmpStrRes, $res, $j+1, strlen($tmpStrRes)-1);
        }
    }
    //$res = array_values(array_unique($res));
    //return $res;
}*/

function arrange($str)
{
    $res = array();
    recur(0,$str,$res);
    //$res = array_unique($res);
    //sort($res);
    return $res;
}

function recur($step,&$str,&$res){
    echo "recur step: $step\n";
    if($step == strlen($str)-1){
        $res[] = $str;
        echo "push str: $str\n";
    }
    for($i = $step;$i < strlen($str);$i++){
        $tmp = $str[$step];
        $str[$step] = $str[$i];
        $str[$i] = $tmp;
        echo "基础位置step: $step\n";
        echo "交换位置i: $i\n";
        echo "基础元素: $tmp\n";
        echo "str 交换: $str\n";
        echo "---------进入下一层\n";
        recur($step+1,$str,$res);
        echo "---------退出下一层\n";
        //step复位
        $tmp = $str[$step];
        $str[$step] = $str[$i];
        $str[$i] = $tmp;
        echo "基础位置step: $step\n";
        echo "复位位置i: $i\n";
        echo "复位元素: $tmp\n";
        echo "str 复位: $str\n";
    }
    print_r($res);
}

$str = 'abcd';
$res = arrange($str);
print_r($res);
