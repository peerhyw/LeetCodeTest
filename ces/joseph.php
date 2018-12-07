<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-23
 * Time: 下午3:28
 */

require_once "listNode.php";

function generateList($n){
    $head = $pre = new listNode(0);
    for ($i = 1; $i < $n; $i++){
        $node = new listNode($i);
        $pre->next = $node;
        $pre = $node;
    }
    $pre->next = $head;
    return $head;
}

function joseph($n,$m){
    $node = generateList($n);
    while($node->next !== $node){
        $step = 1;
        while($step < $m-1){
            $node = $node->next;
            $step++;
        }
        $temp = $node->next;
        $node->next = $node->next->next;
        $node = $node->next;
        unset($temp);
        print_r($node);
    }
    return $node->value;
}

function josephII($n,$m){
    $r = 0;
    for($i = 2; $i <= $n; $i++){
        $r = ($m + $r) % $i;
        echo "r: $r\n";
    }
    return $r;
}

echo "\nfinal: ".josephII(11,3);