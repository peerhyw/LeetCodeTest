<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-25
 * Time: 下午10:23
 */

require_once "listNode.php";

define('INCREMENTAL',0);
define('DECREMENTAL',1);

function isOrderList($node,$order = INCREMENTAL){
    if($node == null)
        return false;
    while($node->next != null){
        if($order == INCREMENTAL){
            if($node->value > $node->next->value)
                return false;
        }elseif($order == DECREMENTAL){
            if($node->value < $node->next->value)
                return false;
        }
        $node = $node->next;
    }
    return true;
}

function deleteRepeat($head){
    $node = $head;
    if(isOrderList($node,INCREMENTAL) || isOrderList($node,DECREMENTAL)){
        while($node->next != null){
            if($node->value == $node->next->value){
                $node->next = $node->next->next;
                $node = $node->next;
            }else{
                $node = $node->next;
            }
        }
    }
    return $head;
}

$head = new listNode(4);
$a = new listNode(4);
$b = new listNode(3);
$c = new listNode(3);
$d = new listNode(2);
$e = new listNode(2);
$f = new listNode(1);

$head->next = $a;
$a->next = $b;
$b->next = $c;
$c->next = $d;
$d->next = $e;
$e->next = $f;

//echo var_export(isOrderList($head),true);

$head = deleteRepeat($head);
print_r($head);
