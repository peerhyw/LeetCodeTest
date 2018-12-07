<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午10:57
 */

/*
 * 假设现在6个台阶，我们可以从第5跳一步到6，这样的话有多少种方案跳到5就有多少种方案跳到6，
 * 另外我们也可以从4跳两步跳到6，跳到4有多少种方案的话，就有多少种方案跳到6，
 * 其他的不能从3跳到6什么的啦，所以最后就是f(6) = f(5) + f(4)；
*/

function jumpFloor($n){
    $res[0] = 0;
    $res[1] = 1; //跳一级台阶的跳法 1
    $res[2] = 2; //跳两级台阶的跳法 1 1 ，2 （3级台阶：f(2)+f(1) 1 1 1 , 1 2 , 2 1）

    for ($i = 3; $i <= $n; $i++)
        $res[$i] = $res[$i-1] + $res[$i-2];

    return $res[$n];
}

//echo jumpFloor(6);

/*
　　因为n级台阶，第一步有n种跳法：跳1级、跳2级、到跳n级；

　　跳1级，剩下n-1级，则剩下跳法是f(n-1)；

　　跳2级，剩下n-2级，则剩下跳法是f(n-2)，

   所以f(n)=f(n-1)+f(n-2)+...+f(1)，因为f(n-1)=f(n-2)+f(n-3)+...+f(1)，所以f(n)=2*f(n-1)

   所以，f(n)=2的n-1次方。
*/
function hentaiJumpFloor($n){
    if($n == 1)
        return 1;
    return pow(2, $n - 1);
}

function hentaiJumpFloorI($n){
    $res[0] = 0;
    $res[1] = 1;

    for($i = 2; $i <= $n; $i++){
        $res[$i] = 1;
        for($j = 1; $j <= $i - 1; $j++)
            $res[$i] += $res[$j];
    }
    return $res[$n];
}

echo hentaiJumpFloor(5);