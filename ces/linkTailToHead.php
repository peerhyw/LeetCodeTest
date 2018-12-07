<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午5:41
 */

require_once "listNode.php";

function printListFromTailToHead($head){
    $list = [];
    while($head != null){
        $list[] = $head->value;
        $head = $head->next;
    }
    return array_reverse($list);
}

$a = new listNode(1);
$b = new listNode(2);
$c = new listNode(3);
$a->next = $b;
$b->next = $c;

$reverse = printListFromTailToHead($a);
var_dump($reverse);
