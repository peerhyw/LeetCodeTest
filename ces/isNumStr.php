<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-24
 * Time: 下午6:23
 */

function isNumStr($str){
    $strArr = str_split($str);
    $stat = array_count_values($strArr);

    $eExist = in_array('e',$strArr) ? true : false;
    $EExist = in_array('E',$strArr) ? true : false;
    $dotExist = in_array('.',$strArr) ? true : false;
    $positiveExist = in_array('+',$strArr) ? true : false;
    $negativeExist = in_array('-',$strArr) ? true : false;

    $eIndex = array_search('e',$strArr) ?: count($strArr);
    $EIndex = array_search('E',$strArr) ?: count($strArr);
    $dotIndex = array_search('.',$strArr) ?: count($strArr);

    foreach($strArr as $item){
        if(($item <= '0' || $item >= '9') &&
            $item != 'e' && $item != 'E'
            && $item != '+' && $item != '-'
            && $item != '.'){
            echo "m\n";
            return false;
        }
    }

    if($eExist || $EExist){
        if($eExist && $stat['e'] > 1){
            echo "a\n";
            return false;
        }
        if($EExist && $stat['E'] > 1){
            echo "b\n";
            return false;
        }
        if($eExist && $EExist){
            echo "c\n";
            return false;
        }
        if($dotExist){
            if($eExist && $dotIndex > $eIndex){
                echo "d\n";
                return false;
            }
            if($EExist && $dotIndex > $EIndex){
                echo "e\n";
                return false;
            }
        }
        if($positiveExist){
            if($stat['+'] > 2){
                echo "f\n";
                return false;
            }else{
                if($stat['+'] == 1){
                    $index = array_search('+',$strArr);
                    if($strArr[0] != '+' && (($eExist && $index != $eIndex + 1) || ($EExist && $index != $EIndex + 1))){
                        echo "g\n";
                        return false;
                    }
                }else{
                    $temp = $strArr[0];
                    array_shift($strArr);
                    $index = array_search('+',$strArr) + 1;
                    array_unshift($strArr,$temp);
                    if($strArr[0] != '+' || (($eExist && $index != $eIndex + 1) || ($EExist && $index != $EIndex + 1))){
                        echo "h\n";
                        return false;
                    }
                }
            }
        }
        if($negativeExist){
            if($stat['-'] > 2){
                echo "i\n";
                return false;
            }else{
                if($stat['-'] == 1){
                    $index = array_search('-',$strArr);
                    if($strArr[0] != '-' && (($eExist && $index != $eIndex + 1) || ($EExist && $index != $EIndex + 1))){
                        echo "j\n";
                        return false;
                    }
                }else{
                    $temp = $strArr[0];
                    array_shift($strArr);
                    $index = array_search('-',$strArr) + 1;
                    array_unshift($strArr,$temp);
                    if($strArr[0] != '-' || (($eExist && $index != $eIndex + 1) || ($EExist && $index != $EIndex + 1))){
                        echo "k\n";
                        return false;
                    }
                }
            }
        }
        if($dotExist && ($dotIndex > $eIndex || $dotIndex > $EIndex)){
            echo "l\n";
            return false;
        }
    }else{
        if($positiveExist && $negativeExist || $positiveExist && $stat['+'] > 1 || $negativeExist && $stat['-'] > 1){
            echo "n\n";
            return false;
        }
    }

    if($dotExist && $stat['.'] > 1){
        echo "o\n";
        return false;
    }

    return true;
}

$str = '+123e+4567';
echo $str.PHP_EOL;
echo var_export(isNumStr($str),true);
