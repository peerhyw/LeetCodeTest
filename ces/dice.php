<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午11:40
 */

function dice($n, &$res, $sum = []){
    if($n < 0)
        return null;
    if($n == 1){
        for ($i = 1; $i <= 6; $i++){
            $sum[] = $i;
            $res[] = $sum;
            array_pop($sum);
        }
    }else{
        for($i = 1; $i <= 6; $i++){
            $sum[] = $i;
            dice($n-1, $res, $sum);
            array_pop($sum);
        }
    }
}

function probability($res){
    if($res == null)
        return null;
    foreach ($res as $key => $combine){
        $res[$key] = array_sum($combine);
    }

    $count = count($res);
    $res = array_count_values($res);
    foreach ($res as $key => $times){
        $res[$key] = (float)($times/$count);//round((float)($times/$count),2);

    }
    return $res;
}

function diceII($n){
    if($n < 0)
        return null;
    $res = [];

    //数据初始化
    for ($i = 0; $i < $n * 6 + 1; $i++){
        $res[0][$i] = 0;
        $res[1][$i] = 0;
    }

    $flag = 0;

    //抛出第一个骰子
    for ($i = 1; $i <= 6; $i++){
        $res[$flag][$i] = 1;
    }

    //抛出其他骰子
    for ($k = 2; $k < $n; $k++){
        // 如果抛出了k个骰子，那么和为[0, k-1]的出现次数为0 抛了k次 最小值 就是 k×1=k
        for($i = 0; $i < $k; $i++){
            $res[1-$flag][$i] = 0;
        }

        //抛出k个骰子 所有和的可能 [k,k*6]
        for ($i = $k; $i <= $k * 6; $i++){
            $res[1-$flag][$i] = 0;

            //每个骰子的出现的所有可能的点数
            for ($j = 1; $j <= $i && $j <= 6; $j++){
                //统计出和为i的点数出现的次数
                $res[1-$flag][$i] += $res[$flag][$i-$j];
            }
            //print_r($res[1-$flag]);
        }
        $flag = 1 - $flag;
    }
    return $res[$flag];
}

$res = [];
dice(4,$res);
print_r($res);

$pro = probability($res);
print_r($pro);
echo array_sum($pro);

/*$res = diceII(3);
print_r($res);*/