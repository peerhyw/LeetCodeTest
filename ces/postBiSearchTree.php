<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午8:46
 */

/*
思路：
只要想清楚左节点比根节点小，右节点比根节点大就很容易解出，
首先将数组的大小赋给$size，对$size进行while循环，
这里有一个很重要的变量$i，两个while循环一个判断左节点和根节点的大小关系，
若左小于根，则$i++，继续循环，之后判断右是否大于根，若大于，$i++，
然后判断变量i和变量size的大小关系，
如果i小于size，则说明没有循环完，即这不是一个二叉搜索树，返回false，反之则继续size--循环，
当然要将i重新赋值0，直到size为0时，循环结束，返回true。
*/


function VerifySquenceOfBST($sequence)
{
    // write code here
    $size = count($sequence);
    if($size == 0){
        return false;
    }
    $i = 0;
    while($size--){
        echo "size: ".$size."\n";
        while($sequence[$i] < $sequence[$size])
            $i++;
        echo "l i: ".$i."\n";
        while($sequence[$i] > $sequence[$size])
            $i++;
        echo "r i: ".$i."\n";
        if($i != $size){
            return false;
        }
        $i = 0;
    }
    return true;
}

echo var_export(VerifySquenceOfBST([3,4,5,8,7,6]));
echo var_export(VerifySquenceOfBST([3,4,5,8,6,7]));