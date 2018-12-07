<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午1:16
 */

require_once "listNode.php";

function findReciprocal($head, $pos){
    $len = 0;
    $tmp = $head;

    while($head != null){
        $head = $head->next;
        $len++;
    }

    if($len < $pos)
        return null;

    for($i = 0; $i < $len - $pos; $i++)
        $tmp = $tmp->next;

    return $tmp;
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

var_dump($head);
$res = findReciprocal($head,3);
echo $res->value;