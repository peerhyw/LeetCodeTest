<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午9:33
 */
/*
 * 考虑用两个数small 和big 分别表示序列的最小值和最大值。
 * 首先把small 初始化为1, big 初始化为2。如果从small 到big 的序列的和大于s，
 * 我们可以从序列中去掉较小的值，也就是增大small 的值。如果从small 到big 的序列的和小于s，
 * 我们可以增大big，让这个序列包含更多的数字。因为这个序列至少要有两个数字，
 * 我们一直增加small 到(1+s)/2 为止。 以求和为9 的所有连续序列为例，
 * 我们先把small 初始化为1, big 初始化为2。此时介于small 和big 之间的序列是｛1，2}，序列的和为3，
 * 小于9，所以我们下一步要让序列包含更多的数字。我们把big 增加1 变成3,此时序列为｛ 1, 2，3}
 * 由于序列的和是6，仍然小于9，我们接下来再增加big 变成4，
 * 介于small 和big 之间的序列也随之变成｛ l, 2, 3, 4｝。
 * 由于列的和10 大于9，我们要删去去序列中的一些数字， 于是我们增加small 变成2，
 * 此时得到的序列是｛2, 3, 4｝， 序列的和E好是9。我们找到了第一个和为9 的连续序列，
 * 把它打印出来。接下来我们再增加big，重复前面的过程，可以找到第二个和为9 的连续序列｛4，5}。
 */

function findSeqSumEqlValue($sum){
    $res = [];
    if($sum < 3)
        return $res;

    $small = 1;
    $big = 2;
    $mid = ($sum + 1) / 2;
    $curSum = $small + $big;

    while($small < $mid){       //small增加到比sum的一半要小或等于的那个数 因为一旦small超过sum的一半
        if($curSum == $sum){    //那么 mid + (mid + 1)肯定大于sum
            $res[] = [$small, $big];
        }

        while($curSum > $sum && $small < $mid){
            $curSum -= $small;
            $small++;

            if($curSum == $sum){
                $res[] = [$small, $big];
            }
        }

        $big++;
        $curSum += $big;
    }

    return $res;
}

$res = findSeqSumEqlValue(15);
print_r($res);