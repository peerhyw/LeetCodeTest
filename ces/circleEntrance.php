<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-25
 * Time: 下午9:23
 */

require_once "listNode.php";

function length($node){
    $res = [];
    $length = 0;
    while(!in_array($node,$res) && $node != null){
        $res[] = $node;
        $node =  $node->next;
        $length++;
    }
    return $length;
}

function circleEntrance($head){
    if($head == null || $head->next == null)
        return false;
    $length = length($head);
    $slow = $head->next;
    $fast = $head->next->next;
    while($slow != $fast){
        $slow = $slow->next;
        $fast = $fast->next->next;
    }
    $tmp = $slow->next;
    $circleLength = 1;
    while($tmp != $slow){
        $tmp = $tmp->next;
        $circleLength++;
    }

    $entrance = $head;
    $i = 0;
    while($i < $length - $circleLength){
        $entrance = $entrance->next;
        $i++;
    }

    return $entrance;
}

$head = new listNode('a');
$b = new listNode('b');
$c = new listNode('c');
$d = new listNode('d');
$e = new listNode('e');
$f = new listNode('f');
$head->next = $b;
$b->next = $c;
$c->next = $d;
$d->next = $e;
$e->next = $f;
$f->next = $c;

//print_r(length($head));
print_r(circleEntrance($head));