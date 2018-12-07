<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午2:11
 */

require_once "listNode.php";

function mergeList($heada, $headb){
    if($heada->value < $headb->value){
        $merge = $heada;
        $heada = $heada->next;
    }else{
        $merge = $headb;
        $headb = $headb->next;
    }

    $p = $merge; //*****
    while($heada && $headb){
        if($heada->value < $headb->value){
            $p->next = $heada;
            $heada = $heada->next;
        }else{
            $p->next = $headb;
            $headb = $headb->next;
        }
        $p = $p->next;  //*****
    }

    if($heada != null){
        $p->next = $heada;
    }

    if($headb != null){
        $p->next = $headb;
    }

    return $merge;
}

$heada = new listNode(1);
$a = new listNode(2);
$b = new listNode(3);
$c = new listNode(4);
$d = new listNode(8);
$headb = new listNode(5);
$e = new listNode(6);
$f = new listNode(7);
$heada->next = $a;
$a->next = $b;
$b->next = $c;
$c->next = $d;
$headb->next = $e;
$e->next = $f;

print_r(mergeList($heada,$headb));