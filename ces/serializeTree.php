<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-26
 * Time: 上午3:19
 */

require_once "biTreeNode.php";

function biTreeSerialize($root){
    if($root == null){
        $order = '#';
        return $order;
    }else{
        $order = $root->value;
        $order .= ','.biTreeSerialize($root->lchild);
        $order .= ','.biTreeSerialize($root->rchild);
        return $order;
    }
}

function biTreeDeserialize($order){
    $order = str_replace(',','',$order);
    if($order[0] == '#')
        return null;
    else{
        $root = new biTreeNode($order[0]);
        $root->lchild = biTreeDeserialize(substr($order,1,strlen($order) / 2));
        $root->rchild = biTreeDeserialize(substr($order,strlen($order) / 2 + 1));
        return $root;
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
$c->lchild = $f;
$c->rchild = $g;

$order = biTreeSerialize($root);
echo $order.PHP_EOL;

$root = biTreeDeserialize($order);
print_r($root);