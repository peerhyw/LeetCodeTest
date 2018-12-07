<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-26
 * Time: 上午5:38
 */

require_once "biTreeNode.php";

function in($root, $in = []){
    if($root != null){
        $in = in($root->lchild,$in);
        $in[] = $root->value;
        $in = in($root->rchild,$in);
    }
    return $in;
}

function findKth($root,$k){
    $in = in($root);
    if($k < 1 || $k > count($in))
        return false;
    return $in[$k-1];
}

$root = new biTreeNode(6);
$b = new biTreeNode(4);
$c = new biTreeNode(8);
$d = new biTreeNode(3);
$e = new biTreeNode(5);
$f = new biTreeNode(7);
$g = new biTreeNode(9);

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$c->lchild = $f;
$c->rchild = $g;

echo findKth($root,7);