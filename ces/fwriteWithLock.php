<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-30
 * Time: 下午9:51
 */

function writeData($filePath,$data,$maxRetries = 10){
    $fp = fopen($filePath,'a');
    $retries = 0;
    do{
        if($retries > 0){
            usleep(100);
        }
        $retries++;
    }while(!flock($fp,LOCK_EX) && $retries <= $maxRetries);  //暂停执行 直到加锁成功

    if($retries == $maxRetries)
        return false;
    $res = fwrite($fp,$data."/n");
    flock($fp,LOCK_UN);
    fclose($fp);
    return $res;
}
// unlink() delete a file