<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-12
 * Time: 上午12:13
 */
class Lrs{
    function comlen($str,$i,$j){
        $len = 0;
        while($i < strlen($str) && $j < strlen($str) && $str[$i] == $str[$j]){
            $len++;
            $i++;
            $j++;
        }
        return $len;
    }

    function LRS_base($str){
        $maxlen = 0;
        $maxIndex = 0;
        for($i = 0; $i < strlen($str); $i++){   // a
            for($j = $i + 1; $j < strlen($str); $j++){  // b
                $len = $this->comlen($str,$i,$j);
                if($len > $maxlen){
                    $maxlen = $len;
                    $maxIndex = $i;
                }
            }
        }
        echo "maxlen: ".$maxlen." maxIndex: ".$maxIndex."\n";
        echo "max substr: ".substr($str,$maxIndex,$maxlen)."\n";
    }
}

/*
 * a |b| |c| dvbbcdx  //b
 *   |a| bcdvbbcdx    //a
 *      |a| bcdvbbcdx //a
 *   ....
 * ab |c| |d| vbbcdx  //b
 *  a |b| cdvbbcdx    //a
 *     a |b|cdvbbcdx  //a
 * */


$str = 'abcdvbbcdx';
$lrs = new Lrs();
$lrs->LRS_base($str);

class kmp{function getnextval($str){
    //$str = "\0".$str;
    //echo $str;
    $i = 1;
    $j = 0;
    $nexval[1] = 0;
    while($i < strlen($str)-1){
        if($j == 0 || $str[$i] == $str[$j]){
            ++$i;
            ++$j;
            if($str[$i] != $str[$j]){
                $nexval[$i] = $j;
            }else{
                $nexval[$i] = $nexval[$j];
            }
        }else{
            $j = $nexval[$j];
        }
    }
    return $nexval;
}

//$nexval = getnextval('xababaab');
//print_r($nexval);

    function getnext($str){
        $i = 1;
        $j = 0;
        $next[1] = 0;
        while ($i < strlen($str)-1){
            if($j == 0 || $str[$i] == $str[$j]){
                ++$i;
                ++$j;
                $next[$i] = $j;
            }else{
                $j = $next[$j];
            }
        }
        print_r($next);
    }

    function kmp($Tstring, $Pstring, &$next)
    {
        $n = strlen($Tstring); // 字符串
        $m = strlen($Pstring);
        makeNext($Pstring,$next); // 计算模式匹配表

        for ($i = 0, $q = 0; $i < $n; ++$i)
        {
            while($q > 0 && $Pstring[$q] != $Tstring[$i])
                $q = $next[$q-1];
            if ($Pstring[$q] == $Tstring[$i])
            {
                $q++;
            }
            if ($q == $m)
            {
                printf("Pattern occurs with shift:%d ",($i - $m + 1));
                printf(" You find string is:%s\n", $Pstring);
                echo "<br>";
            }
        }
    }

    function getnexts($str){
        $next[0] = 0;
        $j = 0;
        for($i = 1; $i < strlen($str); $i++)
        {
            while ($j > 0 && $str[$j] != $str[$i])
                $j = $next[$j-1];

            if($str[$j] == $str[$i])
                $j++;

            $next[$i] = $j;
        }

        print_r($next);
    }
}

//getnexts('abababb');

function maxUnrepeatSubstr($str){
    $maxlen = 0;
    $l = 0;
    for ($i = 0; $i < strlen($str); $i++){
        for($j = $i + 1; $j < strlen($str); $j++){
            for($k = $i; $k < $j; $k++){
                if($str[$k] == $str[$j]){
                    $l = $j;
                    break;
                }
            }
        }
        if($l - $i > $maxlen){
            $maxlen = $l - $i;
        }
    }
    if ($maxlen == 0){
        $maxlen = strlen($str);
        $l = strlen($str);
    }
    echo "l: ".($l - 1)." maxlen: ".$maxlen."\nmax unrepeated substr: ".substr($str,$maxlen - $l,$maxlen);
}

//maxUnrepeatSubstr('abcdee4');

/*
 * 动态规划思想就是用于处理有重叠问题的求解，最大不重复子串一定是两个相同字符夹着的一段字符串加上这个字符，
 * 如abcac这里的最大不重复子串是a夹的一段。当一个最长子串结束时（即遇到重复的字符），新的子串的长度是与第一个重复的字符的下标有关的，
 * 如果该下标在上一个最长子串起始位置之前，则dp[i] = dp[i-1] + 1，即上一个最长子串的起始位置也是当前最长子串的起始位置；
 * 如果该下标在上一个最长子串起始位置之后，则新的子串是从该下标之后开始的。
 */

function LNRS_dynamicPlanning($str){
    $lastStart = 0;
    $maxlen = $maxIndex = 0;
    $dp[0] = 1;                                                 //            |length|
    for ($i = 1; $i < strlen($str); $i++){                      //lastStart--------->i
        for ($j = $i - 1; $j >= $lastStart; $j--){              //            j<-----
            if($str[$j] == $str[$i]){                           //str[j] == str[i] => dp[i] = i-j(length)
                $dp[$i] = $i - $j;                              //j == lastStart dp[i] = dp[i-1]+1
                $lastStart = $j + 1;
                break;
            }elseif($j == $lastStart){
                $dp[$i] = $dp[$i - 1] + 1;
            }
        }
        if($dp[$i] > $maxlen){
            $maxlen = $dp[$i];
            $maxIndex = $i - $maxlen + 1;
        }
    }
    echo "maxlen: ".$maxlen." maxIndex: ".$maxIndex."\n";
    echo "max substr: ".substr($str,$maxIndex,$maxlen);
}

LNRS_dynamicPlanning('goooogle');