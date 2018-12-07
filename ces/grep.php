<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-24
 * Time: 上午2:09
 */

/*
 * 每次从字符串里拿出一个字符和模式中的字符去匹配。先来分析如何匹配一个字符。
 * 如果模式中的字符ch是‘.’，那么它可以匹配字符串中的任意字符。
 * 如果模式中的字符ch不是’.’而且字符串中的字符也是ch，那么他们相互匹配。
 * 当字符串中的字符和模式中的字符相匹配时，接着匹配后面的字符。
 * 相对而言当模式中的第二个字符不是‘*’时问题要简单很多
 * 如果字符串中的第一个字符和模式中的第一个字符相匹配，
 * 那么在字符串和模式上都向后移动一个字符，然后匹配剩余的字符串和模式。
 * 如果字符串中的第一个字符和模式中的第一个字符不相匹配，则直接返回false。
 * 当模式中的第二个字符是‘*’时问题要复杂一些，因为可能有多种不同的匹配方式。
 * 一个选择是在模式上向后移动两个字符。这相当于‘*’和它面前的字符被忽略掉了，因为‘*’可以匹配字符串中0个字符。
 * 如果模式中的第一个字符和字符串中的第一个字符相匹配时，则在字符串向后移动一个字符，
 * 而在模式上有两个选择：我们可以在模式上向后移动两个字符，也可以保持模式不变。
 * */

function match($str, $pattern){
    if($str == null || $pattern == null)
        return false;
    return matchCore($str, $pattern);
}

//'aaaaaaaaaaa', 'a*.a'
function matchCore($str, $pattern ,$i = 0, $p = 0){
    echo "i: $i\n";
    echo "p: $p\n";
    //匹配串和模式串都到达尾，说明成功匹配
    if($i >= strlen($str) && $p >= strlen($pattern)){
        echo "a\n\n";
        return true;
    }

    //只有模式串到达结尾，说明匹配失败
    if($i != strlen($str) && $p >= strlen($pattern)){
        echo "b\n\n";
        return false;
    }

    //模式串未结束，匹配串有可能结束有可能未结束

    // p位置的下一个字符中为*号
    if($p + 1 < strlen($pattern) && $pattern[$p+1] == '*'){
        //匹配串已经结束
        if ($i >= strlen($str)){
            echo "c\n\n";
            return matchCore($str, $pattern, $i, $p + 2);
        }else{  //匹配串还没有结束
            if($pattern[$p] == $str[$i] || $pattern[$p] == '.'){
                echo "d\n\n";
                // 匹配串向后移动一个位置，模式串向后移动两个位置
                return matchCore($str, $pattern, $i + 1, $p + 2) // 匹配串向后移动一个位置，模式串向后移动两个位置  a*前只匹配到一个a的情况
                        || matchCore($str, $pattern, $i + 1, $p)    // 匹配串向后移动一个位置，模式串不移动  a*前匹配到多个a的情况
                        || matchCore($str, $pattern, $i, $p+2);     // 匹配串不移动，模式串向后移动两个位置 a*前没有匹配到a的情况
            }else{
                echo "e\n\n";
                return matchCore($str, $pattern, $i, $p + 2);
            }
        }
    }

    //匹配串已经结束
    if ($i >= strlen($str)){
        echo "f\n\n";
        return false;
    }else{  //匹配串还没有结束
        if($str[$i] == $pattern[$p] || $pattern[$p] == '.'){
            echo "g\n\n";
            return matchCore($str, $pattern, $i + 1, $p + 1);
        }
    }

    return false;
}

$res = match('aaaaaaaaaaa', 'a*.a');
echo var_export($res,true);