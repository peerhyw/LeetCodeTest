<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午5:59
 */

require_once "listNode.php";

function getLength($node){
    $length = 0;
    while($node){
        $length++;
        $node = $node->next;
    }
    return $length;
}

function getFirstSameNodeI($nodeA, $nodeB){
    $stackA = new SplStack();
    $stackB = new SplStack();

    while($nodeA){
        $stackA->push($nodeA);
        $nodeA = $nodeA->next;
    }

    while($nodeB){
        $stackB->push($nodeB);
        $nodeB = $nodeB->next;
    }

    $temp = null;
    while(!$stackA->isEmpty() && !$stackB->isEmpty()){
        $a = $stackA->pop();
        $b = $stackB->pop();
        $temp = $a->next;
        if($a !== $b)
            break;
    }

    return  $temp;
}

function getFirstSameNodeII($nodeA, $nodeB){
    $lengthA = getLength($nodeA);
    $lengthB = getLength($nodeB);

    if($lengthA < $lengthB){
        $temp = $nodeA;
        $nodeA = $nodeB;
        $nodeB = $temp;
    }

    $step = abs($lengthA - $lengthB);
    for($i = 0; $i < $step; $i++){
        $nodeA = $nodeA->next;
    }

    while($nodeA && $nodeA !== $nodeB){
        $nodeA = $nodeA->next;
        $nodeB = $nodeB->next;
    }

    return $nodeA;
}

$nodeA = new listNode('a');
$b = new listNode('b');
$c = new listNode('c');
$d = new listNode('d');
$e = new listNode('e');
$f = new listNode('f');
$nodeB = new listNode('h');
$i = new listNode('i');
$j = new listNode('j');

$nodeA->next = $b;
$b->next = $c;
$c->next = $d;
$d->next = $e;
$e->next = $f;
$nodeB->next = $i;
$i->next = $j;
$j->next = $d;

//$resA = getFirstSameNodeI($nodeA, $nodeB);
$resB = getFirstSameNodeII($nodeA,$nodeB);

//print_r($resA);
print_r($resB);