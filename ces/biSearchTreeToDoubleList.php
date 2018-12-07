<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午11:56
 */

require_once "biTreeNode.php";

function in($biTreeNode, &$in){
    if($biTreeNode != null){
        in($biTreeNode->lchild, $in);
        $in[] = $biTreeNode->value;
        in($biTreeNode->rchild, $in);
    }
}

function trans($in){
    $list = new SplDoublyLinkedList();
    for ($i = 0; $i < count($in); $i++)
        $list->push($in[$i]);
    return $list;
}

$root = new biTreeNode('6');
$b = new biTreeNode('4');
$c = new biTreeNode('8');
$d = new biTreeNode('3');
$e = new biTreeNode('5');
$f = new biTreeNode('7');
$g = new biTreeNode('9');

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$c->lchild = $f;
$c->rchild = $g;

$in = [];
in($root, $in);
print_r($in);
$list = trans($in);
var_dump($list);