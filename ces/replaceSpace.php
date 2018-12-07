<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 上午4:31
 */

$str = "hello world and fuck you!";
$str = str_replace(' ', '%20', $str);
echo $str;