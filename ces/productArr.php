<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-24
 * Time: 上午1:24
 */

function productArr($arr){
    $product = array_fill(0,count($arr),1);
    for ($i = 0; $i < count($arr); $i++){
        for ($j = 0; $j < count($arr); $j++){
            if($i == $j)
                continue;
            $product[$i] *= $arr[$j];
        }
    }
    return $product;
}

$product = productArr([2,2,3,4,5]);
print_r($product);