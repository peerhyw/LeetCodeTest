<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-26
 * Time: 上午12:57
 */

require_once "biTreeNode.php";

function in($biTreeNode, $in = []){
    if($biTreeNode != null){
        $in = in($biTreeNode->lchild, $in);
        $in[] = $biTreeNode->value;
        $in = in($biTreeNode->rchild, $in);
    }
    return $in;
}

function isSymmetrical($node){
    $in = in($node);

    print_r($in);

    if(count($in) % 2 != 1){
        return false;
    }else{
        $i = 0;
        $j = count($in) - 1;
        $mid = count($in) / 2;
        while($i < $mid && $j > $mid){
            if($in[$i] != $in[$j])
                return false;
            $i++;
            $j--;
        }
        return true;
    }
}

$root = new biTreeNode('a');
$b = new biTreeNode('b');
$c = new biTreeNode('b');
$d = new biTreeNode('c');
$e = new biTreeNode('d');
$f = new biTreeNode('d');
$g = new biTreeNode('c');

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$c->lchild = $f;
$c->rchild = $g;

$in = isSymmetrical($root);
echo var_export($in,true);