<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-31
 * Time: 上午12:15
 */
function getClosetTime($timeArray,$now = null){
    if(is_null($now))
        $now = time();
    $min = $timeArray[0];
    $diff = abs($min - $now);
    $length = count($timeArray);
    for($i = 1; $i < $length; $i++){
        $diffTmp = abs($timeArray[$i] - $now);
        if($diffTmp < $diff){
            $diff = $diffTmp;
            $min = $timeArray[$i];
        }
    }

    return date("Y-m-d H:i:s",$min);
}
function randomTime($count){
    $num = [1,2,3,4];
    $timeFormat = ['seconds','minutes','hours','days','weeks','months','years'];
    $timeStamp = [];
    for($i = 0; $i < $count; $i++){
        $m = array_rand($num,1);
        $n = array_rand($timeFormat,1);
        $timeStamp[$i] = strtotime("+$num[$m] $timeFormat[$n]");
    }
    return $timeStamp;
}
$timeArray = randomTime(5);
foreach ($timeArray as $time){
    //echo $time;
    echo date("Y-m-d H:i:s",$time)."\n";
}
$min = getClosetTime($timeArray);
echo "closet time: ".$min;