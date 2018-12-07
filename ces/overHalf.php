<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-21
 * Time: 下午4:28
 */

function overHalf($arr){
    $count = [];
    for($i = 0; $i < count($arr); $i++){
        if(!array_key_exists($arr[$i], $count)){
            $count[$arr[$i]] = 1;
        }else{
            $count[$arr[$i]]++;
        }
    }

    foreach ($count as $key => $value){
        if($value > (count($arr) / 2)){
            return $key;
        }
    }
    return 0;
}

//这个解法更优
function MoreThanHalfNum_Solution($numbers)
{
    // write code here
    if(count($numbers) <= 0)
        return 0;
    $list = array_count_values($numbers);
    $max = max($list);
    if($max > count($numbers)/2)
        return array_search($max, $list);
    else
        return 0;
}

echo overHalf([1,1,1,2,2,3,3]);