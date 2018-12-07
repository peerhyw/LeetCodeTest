<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午11:18
 */

class randomListNode{
    public $value;
    public $next = null;
    public $random = null;

    public function __construct($value) {
        $this->value = $value;
    }
}

function myClone($node){
    if($node == null)
        return null;
    $newHead = new randomListNode($node->value);
    $p = $newHead;
    $node = $node->next;

    while($node != null){
        $p->next = new randomListNode($node->value);
        $p->next->random = $node->random;
        $node = $node->next;
        $p = $p->next;
    }
    return $newHead;
}

$head = new randomListNode(1);
$a = new randomListNode(2);
$b = new randomListNode(3);
$c = new randomListNode(4);
$d = new randomListNode(5);

$head->next = $a;
$a->next = $b;
$b->next = $c;
$c->next = $d;
$a->random = $c;
$c->random = $head;
$b->random = $d;
$d->random = $a;

function myCloneII($pHead)
{
    if($pHead == NULL){
        return NULL;
    }
    $PnewHead=new RandomListNode($pHead->value);
    $PnewHead->next=myCloneII($pHead->next);
    $PnewHead->random=$pHead->random;
    return $PnewHead;
}
$newHead = myClone($head);
print_r($newHead);
$newHead = myCloneII($head);
//print_r($newHead);