<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-30
 * Time: 下午2:48
 */
function ip(){
    $ip = "false";
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown'))
        $ip = getenv('HTTP_CLIENT_IP');
    elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    echo $ip."\n";
}

ip();

$ip = '111.112.113.114';
preg_match('/([\d]{1,3}\.){1,3}([\d]{1,3})/',$ip,$matchs);
var_dump($matchs);