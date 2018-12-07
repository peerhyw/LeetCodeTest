<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 上午12:12
 */

function isUgly($num){
    while ($num % 2 == 0)
        $num /= 2;
    while ($num % 3 == 0)
        $num /= 3;
    while ($num % 5 == 0)
        $num /= 5;
    if($num == 1)
        return true;
    else
        return false;
}

/*
function uglyNum(){
    $res = [];
    $res[0] = 0;
    $res[1] = 1;
    $res[2] = 2;
    $res[3] = 3;
    $res[4] = 5;
    for($i = 1; count($res) < 150; $i++){
        if (isUgly($res[$i] * 2))
            $res[] = $res[$i] * 2;
        if (isUgly($res[$i] * 3))
            $res[] = $res[$i] * 3;
        if (isUgly($res[$i] * 5))
            $res[] = $res[$i] * 5;
        //echo count($res)."\n";
        //echo $minus = count(array_diff($res,array_unique($res)));
        $res = array_values(array_unique($res));
        //$i -= $minus;
    }
    //echo "final count: ".count($res)."\n";
    sort($res);
    return $res;
}
*/

/*
根据丑数的定义， 丑数应该是另一个丑数乘以2、3 或者5 的结果（1除外）。
因此我们可以创建一个数组，里面的数字是排好序的丑数，每一个丑数都是前面的丑数乘以2、3或者5得到的。

这种思路的关键在于怎样确保数组里面的丑数是排好序的。
假设数组中已经有若干个丑数排好序后存放在数组中，并且把己有最大的丑数记做M，
我们接下来分析如何生成下一个丑数。该丑数肯定是前面某一个丑数乘以2、3 或者5 的结果，
所以我们首先考虑把已有的每个丑数乘以2。在乘以2 的时钝能得到若干个小于或等于M 的结果。
由于是按照顺序生成的，小于或者等于M 肯定己经在数组中了，我们不需再次考虑：还会得到若干个大于M 的结果，
但我们只需要第一个大于M 的结果，因为我们希望丑数是按从小到大的顺序生成的，其他更大的结果以后再说。
我们把得到的第一个乘以2 后大于M 的结果记为M2，同样，我们把已有的每一个丑数乘以3 和5，
能得到第一个大于M 的结果M3 和M，那么下一个丑数应该是M2、M3 和M5这3个数的最小者。

前面分析的时候，提到把已有的每个丑数分别都乘以2、3 和5。事实上这不是必须的，
因为已有的丑数是按顺序存放在数组中的。对乘以2而言，
肯定存在某一个丑数T2，排在它之前的每一个丑数乘以2 得到的结果都会小于已有最大的丑数，
在它之后的每一个丑数乘以2 得到的结果都会太大。我们只需记下这个丑数的位置，
同时每次生成新的丑数的时候，去更新这个T2。对乘以3 和5 而言， 也存在着同样的T3和T5。
*/

/*
 * 已求出丑数数组： 1 2 3 4 5 6 8 9 10 12 15 16 18 20 24 25
 * max: 25
 * 15 之前的所有丑数*2 小于等于25 => q2 = 10
 * 9 之前的所有丑数*3 小于等于25 => q3 = 7
 * 6 之前的所有丑数*5 小于等于25 => q5 = 5
 * [q2] * 2 = 30 [q3] * 3 = 27 [q5] * 5 = 30
 * =>min: 27
 * 丑数数组最新元素: 27
 */

function uglyNum($index){
    if($index <= 0)
        return 0;
    $uglyNums = [];
    $uglyNums[0] = 1;
    $nextUglyIndex = 1;

    $p2 = $p3 = $p5 =  0;
    while($nextUglyIndex < $index){
        $min = min($uglyNums[$p2] * 2, $uglyNums[$p3] * 3, $uglyNums[$p5] * 5);
        $uglyNums[$nextUglyIndex] = $min;

        while($uglyNums[$p2] * 2 <= $uglyNums[$nextUglyIndex])
            $p2++;

        while($uglyNums[$p3] * 3 <= $uglyNums[$nextUglyIndex])
            $p3++;

        while($uglyNums[$p5] * 5 <= $uglyNums[$nextUglyIndex])
            $p5++;

        $nextUglyIndex++;
    }
    return $uglyNums;
}

function uglyNumII($index){
    $res = [];
    if ($index <= 0)
        return 0;
    $num = 0;
    $uglyFound = 0;
    while($uglyFound < $index){
        $num++;
        if(isUgly($num)){
            $uglyFound++;
            $res[] = $num;
        }
    }
    return $res;
}

$res = uglyNum(1500);
//$resII = uglyNum();
//print_r($resII);
print_r($res);