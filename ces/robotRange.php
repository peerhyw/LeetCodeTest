<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-28
 * Time: 上午2:36
 */

//这是最好的解法 完全我自己想出来的
function robotRangeBestVer($m,$n,$k){
    $res = [];
    for($i = 0; $i < $m; $i++){
        for($j = 0; $j < $n; $j++){
            $xSum = array_sum(str_split(strval($i)));
            $ySum = array_sum(str_split(strval($j)));
            if($xSum + $ySum > $k){
                $res[$i][$j] = 0;
                if($m == 1 || $n == 1)
                    break 2;
            }
            else{
                $res[$i][$j] = 1;
            }
        }
    }
    $count = 0;
    foreach ($res as $item){
        $count += array_count_values($item)[1] ?? 0;
    }
    return $count;
}

$res = robotRangeBestVer(20,20,15);
echo $res.PHP_EOL;
//echo $res[35][38].PHP_EOL;
/*foreach ($res as $row){
    foreach ($row as $col){
        echo "$col ";
    }
    echo PHP_EOL;
}*/

function robotRange($m,$n,$k,&$res,&$include,$i = 0,$j = 0){
    $xSum = array_sum(str_split(strval($i)));
    $ySum = array_sum(str_split(strval($j)));
    $count = 0;
    if($xSum + $ySum <= $k){
        $include[$i][$j] = 1;
        $res[] = [$i,$j,$xSum+$ySum];
        $count = 1;
        if($i - 1 >= 0 && $include[$i-1][$j] == 0){
            $count += robotRange($m,$n,$k,$res, $include,$i-1,$j);
        }
        if($i + 1 < $m && $include[$i+1][$j] == 0){
            $count += robotRange($m,$n,$k,$res, $include,$i+1,$j);
        }
        if($j - 1 >= 0 && $include[$i][$j-1] == 0){
            $count += robotRange($m,$n,$k,$res, $include,$i,$j-1);
        }
        if($j + 1 < $n && $include[$i][$j+1] == 0){
            $count += robotRange($m,$n,$k,$res, $include,$i,$j+1);
        }
        return $count;
    }
    return $count;
}

function robotRangeJavaVer($m,$n,$k,&$res,&$include,$i = 0,$j = 0){
    $count = 0;
    if(check($m,$n,$k,$i,$j,$include)){
        $res[] = [$i,$j];
        $include[$i][$j] = 1;
        $count = 1 + robotRangeJavaVer($m,$n,$k,$res,$include,$i-1,$j)
                   + robotRangeJavaVer($m,$n,$k,$res,$include,$i,$j-1)
                   + robotRangeJavaVer($m,$n,$k,$res,$include,$i+1,$j)
                   + robotRangeJavaVer($m,$n,$k,$res,$include,$i,$j+1);
    }
    return $count;
}

function check($m,$n,$k,$i,$j,$include){
    return $i >= 0 && $i < $m
            && $j >=0 && $j < $n
            && array_sum(str_split(strval($i))) + array_sum(str_split(strval($j))) <= $k
            && $include[$i][$j] == 0;
}

function robotReach($m,$n,$k){
    $include = [];
    for($i = 0; $i < $m; $i++){
        $include[$i] = array_fill(0,$n,0);
    }
    $res = [];
    //$count = robotRange($m,$n,$k,$res,$include);
    $count = robotRangeJavaVer($m,$n,$k,$res,$include);
    /*foreach ($include as $key => $row){
        echo $key." : ";
        foreach ($row as $col){
            echo "$col ";
        }
        echo PHP_EOL;
    }*/
    return $count;
}

$count = robotReach(100,1,10);
echo "count: ".$count.PHP_EOL;

