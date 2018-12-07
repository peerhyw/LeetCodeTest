<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-26
 * Time: 上午2:02
 */

require_once "biTreeNode.php";

function layer($node,  &$res, $layer = 0){
    if($node != null){
        $res[$layer][] = $node->value;
        layer($node->lchild, $res, $layer + 1);
        layer($node->rchild, $res, $layer + 1);
    }
}

function Zprint($root){
    $res = [];
    layer($root,$res);
    for($i = 0; $i < count($res); $i++){
        if($i % 2 == 0){
            for($j = 0; $j < count($res[$i]); $j++){
                echo $res[$i][$j].' ';
            }
            echo PHP_EOL;
        }else{
            for($j = count($res[$i]) - 1; $j >= 0; $j--){
                echo $res[$i][$j].' ';
            }
            echo PHP_EOL;
        }
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

Zprint($root);
