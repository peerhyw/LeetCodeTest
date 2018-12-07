<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-31
 * Time: 上午12:00
 */
function getExtension($url){
    $arr = parse_url($url);
    var_dump($arr);
    $result = pathinfo($arr['path']);
    var_dump($result);
}

getExtension('http://www.sina.com.cn/abc/de/fg.php?id=1');