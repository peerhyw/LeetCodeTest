<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-1
 * Time: 下午11:09
 */
function callback($a=null,callable $b=null){
    if($b){
        $b($a);
    }
}

callback([1,2],function($a){
    for($i = 0; $i < count($a); $i++){
        echo $a[$i]."\n";
    }
});