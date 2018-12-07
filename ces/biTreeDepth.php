<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-22
 * Time: 下午6:52
 */

require_once "biTreeNode.php";

function biTreeDepth($root, &$res, $i = 1){
    if($root != null){
        $res[] = $i;
        biTreeDepth($root->lchild, $res, $i+1);
        biTreeDepth($root->rchild, $res, $i+1);
    }
    return max($res);
}

$root = new biTreeNode('a');
$b = new biTreeNode('b');
$c = new biTreeNode('c');
$d = new biTreeNode('d');
$e = new biTreeNode('e');
$f = new biTreeNode('f');
$g = new biTreeNode('g');
$h = new biTreeNode('h');

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$e->lchild = $g;
$c->rchild = $f;
$g->lchild = $h;

$res  = [];
echo biTreeDepth($root, $res);