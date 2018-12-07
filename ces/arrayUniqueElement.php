<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-1
 * Time: 上午2:35
 */
function findUnique($array){
    if(!is_array($array))
        return false;
    $tempArr = array_unique($array);  //去除重复
    $tempDiffArr = array_diff_assoc($array,$tempArr); //列出重复
    $diffArr = array_unique($tempDiffArr);  //重复去重复
    $uniqueArr = array_diff($tempArr,$diffArr); //取出不重复
    return $uniqueArr;
}

$arr = [5,1,2,2,2,2,2,3,3,3,2,2,4,5,'a','a','b'];
$uniqueArr = findUnique($arr);
var_dump($uniqueArr);