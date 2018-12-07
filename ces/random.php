<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-30
 * Time: 下午5:20
 */
function get_random_array($min,$max,$number)
{
    $data = [];
    for($i = 0;$i<$number;$i++)
    {
        $d = mt_rand($min,$max);
        if(in_array($d,$data)) {
            $i--;
        }else{
            $data[] = $d;
        }
    }
    return $data;
}

$data = get_random_array(0,100,10);
var_dump($data);