<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-2
 * Time: 下午4:58
 */
function getExtension($file,$flag = 0){
    $file = basename($file);
    if($flag == 0){
        $filePart = explode('.',$file);
        $extension = $filePart[count($filePart) - 1];
        return $extension;
    }elseif($flag == 1){
        $pos = strrpos($file,'.');
        $extension = substr($file,$pos+1);
        return $extension;
    }
}

$res = getExtension('./ext/ces.php',1);
echo $res;