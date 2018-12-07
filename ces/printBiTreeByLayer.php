<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午8:17
 */

require_once "biTreeNode.php";

function printBiTreeByLayer($node,  &$res, $layer = 0){
    if($node != null){
        $res[$layer][] = $node->value;
        printBiTreeByLayer($node->lchild, $res, $layer + 1);
        printBiTreeByLayer($node->rchild, $res, $layer + 1);
    }
}

$root = new biTreeNode('a');
$b = new biTreeNode('b');
$c = new biTreeNode('c');
$d = new biTreeNode('d');
$e = new biTreeNode('e');
$f = new biTreeNode('f');
$g = new biTreeNode('g');

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$e->lchild = $g;
$c->rchild = $f;

$res = [];
printBiTreeByLayer($root, $res);
print_r($res);
