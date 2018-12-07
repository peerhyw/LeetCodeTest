<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午12:03
 */

/*
 * 我们可以用2*1的小矩形横着或者竖着去覆盖更大的矩形。
 * 请问用n个2*1的小矩形无重叠地覆盖一个2*n的大矩形，
 * 总共有多少种方法？
 */

function rectCover($n){
    if($n == 0)
        return 0;
    $res[0] = 0;
    $res[1] = 1;
    $res[2] = 2;

    for($i = 3; $i <= $n; $i++){
        $res[$i] = $res[$i-1] + $res[$i-2];
    }

    return $res[$n];
}

echo rectCover(5);