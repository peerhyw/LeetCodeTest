<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午1:46
 */

require_once "listNode.php";

function reverseList($head){
    $reverse = new listNode(null);
    while($head != null){
        $tmp = $head;
        $head = $head->next;
        $tmp->next = $reverse->next;
        $reverse->next = $tmp;
    }

    unset($reverse);
    $reverse = $tmp;
    return $reverse = $tmp;
}

$head = new listNode(1);
$a = new listNode(2);
$b = new listNode(3);
$c = new listNode(4);
$d = new listNode(5);
$e = new listNode(6);
$f = new listNode(7);
$head->next = $a;
$a->next = $b;
$b->next = $c;
$c->next = $d;
$d->next = $e;
$e->next = $f;

$reverse = reverseList($head);

print_r($reverse);