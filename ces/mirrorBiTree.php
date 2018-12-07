<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午5:19
 */
require_once "biTreeNode.php";

function mirrorBiTree($root){
    if($root != null && ($root->lchild != null || $root->rchild != null)){
        $temp = $root->lchild;
        $root->lchild = $root->rchild;
        $root->rchild = $temp;
        mirrorBiTree($root->lchild);
        mirrorBiTree($root->rchild);
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

mirrorBiTree($root);
print_r($root);