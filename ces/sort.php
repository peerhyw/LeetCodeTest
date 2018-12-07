<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-13
 * Time: 下午5:40
 */

function multiSort(Array $arr){
    while(count($arr)){ // *
        $max = 0;
        $max_key = '';
        foreach ($arr as $key => $value) {
            if($value > $max){
                $max = $value;
                $max_key = $key;
            }elseif($max == $value && $max_key > $key){ // * 按键排序呢
                $max = $value;
                $max_key = $key;
            }
        }
        //每找出最大的元素就从原数组删除加入新数组 原数组长度-1重新排序找出最大值

        unset($arr[$max_key]);
        $arrNew[$max_key] = $max; // *
    }
    print_r($arrNew);
}

multiSort(['a' => 200, 'e' => 100, 'c' => 100, 'd' => 150]);