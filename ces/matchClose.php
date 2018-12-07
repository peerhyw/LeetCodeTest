<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-1
 * Time: 上午12:31
 */
function close($string){
    if(empty($string)){
        return false;
    }
    $length = strlen($string);
    if($length % 2 == 1){
        return false;
    }
    for($i = 0; $i < $length; $i++){
        if($string[$i] == '('){
            if($string[$length-$i-1] != ')'){
                return false;
            }
        }else{
            if($string[$length-$i-1] != '('){
                return false;
            }
        }
    }
    return true;
}

function match($string){
    if(empty($string)){
        echo "a";
        return false;
    }
    $length = strlen($string);
    if($length % 2 == 1){
        echo "b";
        return false;
    }
    if($string[0] == ')' || $string[0] == ']' || $string[0] == '}'){
        echo "c";
        return false;
    }
    $stack = [];
    $j = -1;
    for($i = 0; $i < $length; $i++){
        if($string[$i] == '(' || $string[$i] == '[' || $string[$i] == '{'){
            echo "i: ".$i."\n";
            $stack[++$j] = $string[$i];
        }elseif($string[$i] == ')'){
            if($stack[$j] == '('){
                echo "i:".$i." ".$stack[$j]."\n";
                $stack[$j] = null;
                $j--;
            }else{
                echo $stack[$j]."\n";
                $stack[++$j] = $string[$i];
            }
        }elseif($string[$i] == ']'){
            if($stack[$j] == '['){
                echo "i:".$i." ".$stack[$j]."\n";
                $stack[$j] = null;
                $j--;
            }else{
                echo $stack[$j]."\n";
                $stack[++$j] = $string[$i];
            }
        }elseif($string[$i] == '}'){
            if($stack[$j] == '{'){
                echo "i:".$i." ".$stack[$j]."\n";
                $stack[$j] = null;
                $j--;
            }else{
                echo $stack[$j]."\n";
                $stack[++$j] = $string[$i];
            }
        }
    }
    var_dump(array_unique($stack));
    if(is_null($stack[0])){
        return true;
    }else{
        echo "d";
        return false;
    }
}

$string = '([{}][{{}())';
if(match($string))
    echo "true";
else
    echo "false";