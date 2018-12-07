<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-13
 * Time: 上午1:49
 */


/*
 添加一个标记数组tag，用于记录子集中对应的元素是否出现。每输出一个子集，结束当前步骤，并进入下一步，直至递归完毕
*/

function subSets(Array $arr,Array &$tag = [],$n = 0){
    $count = count($arr);
    if($n == $count){
        echo "{ ";
        for($i = 0; $i < $count; $i++){
            if($tag[$i] == 1){
                echo $arr[$i]." ";
            }
        }
        echo "}\n";
        return;
    }
    $tag[$n] = 0;
    subSets($arr,$tag,$n+1);
    $tag[$n] = 1;
    subSets($arr,$tag,$n+1);
}

subSets([1,2,3,4]);
