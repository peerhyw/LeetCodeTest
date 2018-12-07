<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午10:14
 */

require_once "biTreeNode.php";

function findPath($root, $expectNumber)
{
    // write code here
    $arr = $tmp = [];
    if(!$root){
        return $arr;
    }
    find($root,$expectNumber,$arr,$tmp);
    return $arr;
}

function find($root,$sum,&$arr,$tmp){  //$tmp是关键 不是引用型 只记录上层已经扫描到的节点
    if($root != null){
        $sum -= $root->value;
        $tmp[] = $root->value;
        print_r($tmp);
        if($sum > 0){
            find($root->lchild,$sum,$arr,$tmp);
            find($root->rchild,$sum,$arr,$tmp);
        }elseif($sum==0 && $root->lchild == null && $root->rchild == null){
            $arr[] = $tmp; //不同递归节点的tmp是不同的
        }
    }
}

$root = new biTreeNode('4');
$b = new biTreeNode('3');
$c = new biTreeNode('2');
$d = new biTreeNode('1');
$e = new biTreeNode('1');
$f = new biTreeNode('5');
$g = new biTreeNode('2');

$root->lchild = $b;
$root->rchild = $c;
$b->lchild = $d;
$b->rchild = $e;
$c->lchild = $f;
$c->rchild = $g;

$res = findPath($root, 8);
print_r($res);