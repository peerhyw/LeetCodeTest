<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-25
 * Time: 下午11:18
 */

class cpTreeNode{
    public $value;
    public $lchild = null;
    public $rchild = null;
    public $parent = null;

    public function __construct($value) {
        $this->value = $value;
    }
}

function inFirst($node){
    if($node == null)
        return null;
    if($node->lchild == null)
        return $node->value;
    if($node->lchild != null){
        inFirst($node->lchild);
    }
}

function nextNode($node){
    if($node == null)
        return null;
    if($node->rchild != null){
        return inFirst($node->rchild);
    }else{
        if($node->parent != null){
            if($node->parent->lchild == $node){
                return $node->parent->value;
            }else{
                while($node != null && $node->parent->rchild == $node){
                    $node = $node->parent;
                }
                if($node->parent != null){
                    return $node->parent->value;
                }else{
                    return null;
                }
            }
        }else{
            return null;
        }
    }
}

$root = new cpTreeNode('a');
$b = new cpTreeNode('b');
$c = new cpTreeNode('c');
$d = new cpTreeNode('d');
$e = new cpTreeNode('e');

/*$root->rchild = $b;
$b->lchild = $c;
$b->rchild = $d;
$d->rchild = $e;

$b->parent = $root;
$c->parent = $b;
$d->parent = $b;
$e->parent = $d;*/

/*$root->lchild = $b;
$root->rchild = $e;
$b->lchild = $c;
$c->lchild = $d;

$b->parent = $root;
$c->parent = $b;
$d->parent = $c;
$e->parent = $root;*/

/*$root->rchild = $b;
$b->rchild = $c;
$c->lchild = $d;

$b->parent = $root;
$c->parent = $b;
$d->parent = $c;*/

$root->lchild = $b;
$b->rchild = $c;
$c->rchild = $d;
$d->lchild = $e;

$b->parent = $root;
$c->parent = $b;
$d->parent = $c;
$e->parent = $d;

$res = nextNode($d);
print_r($res);
