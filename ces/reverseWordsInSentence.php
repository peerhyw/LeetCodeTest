<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午10:33
 */

function reverse($str){
    $words = explode(' ',$str);
    $words = array_reverse($words);
    $str = implode(' ',$words);
    return $str;
}

function reverseChar($str, $index){
    if($index > strlen($str))
        return null;
    $pre = substr($str,0,$index);
    $post = substr($str,$index);
    return $res = $post.$pre;
}

function reverseCharII($str, $index){
    if($index > strlen($str))
        return null;
    for ($i = 0, $j = $index-1; $i < $j; $i++, $j--){
        $temp = $str[$i];
        $str[$i] = $str[$j];
        $str[$j] = $temp;
    }
    echo $str.PHP_EOL;

    for ($i = $index, $j = strlen($str)-1; $i < $j; $i++, $j--){
        $temp = $str[$i];
        $str[$i] = $str[$j];
        $str[$j] = $temp;
    }
    echo $str.PHP_EOL;

    for ($i = 0, $j = strlen($str)-1; $i < $j; $i++, $j--){
        $temp = $str[$i];
        $str[$i] = $str[$j];
        $str[$j] = $temp;
    }
    echo $str.PHP_EOL;

    return $str;
}

$str = 'hello world! fuck you';
echo reverse($str).PHP_EOL.PHP_EOL;

$rev = 'abcdefg';
echo reverseChar($rev, 2).PHP_EOL.PHP_EOL;
echo reverseCharII($rev, 2);