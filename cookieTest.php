<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-30
 * Time: 下午4:46
 */

if($_COOKIE['test']){
    $currentCookieValue = $_COOKIE['test'];
    echo "current cookie value is: $currentCookieValue\n";
    echo "cookie exists, and it gonna reset a random value:\n";
    if(setcookie('test',random_bytes(16),time()+60*60))
        echo "reset cookie success!\n";
    else
        echo "reset cookie fail, please retry.\n";
}else{
    if (setcookie('test','this is a cookie test',time()+60*60))
        echo "set cookie success!\n";
    else
        echo "set cookie fail, please retry.\n";
}