<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午3:57
 */

require_once "biTreeNode.php";

function pre($biTreeNode, &$pre){
    if($biTreeNode != null){
        $pre[] = $biTreeNode->value;
        pre($biTreeNode->lchild, $pre);
        pre($biTreeNode->rchild, $pre);
    }
}

function preII($biTreeNode, $pre = []){
    if($biTreeNode != null){
        $pre[] = $biTreeNode->value;
        $pre = preII($biTreeNode->lchild, $pre);
        $pre = preII($biTreeNode->rchild, $pre);
    }
    return $pre;
}

function in($biTreeNode, &$in){
    if($biTreeNode != null){
        in($biTreeNode->lchild, $in);
        $in[] = $biTreeNode->value;
        in($biTreeNode->rchild, $in);
    }
}

function inII($biTreeNode, $in = []){
    if($biTreeNode != null){
        $in = inII($biTreeNode->lchild, $in);
        $in[] = $biTreeNode->value;
        $in = inII($biTreeNode->rchild, $in);
    }
    return $in;
}

function isSubTree($root, $subRoot){
    $pre = $in = $subPre = $subIn = [];
    pre($root, $pre);
    pre($subRoot, $subPre);
    in($root, $in);
    in($subRoot, $subIn);

    if(!$pre || !$in || !$subPre || !$subIn){
        return false;
    }

    $isInPre = isInOrder($pre, $subPre);
    $isInIn = isInOrder($in, $subIn);

    if($isInPre && $isInIn){
        return true;
    }
    return false;
}

function isInOrder($order, $subOrder){
    $index = array_search($subOrder[0], $order);
    if($index !== false){
        $i = 1;
        $index += 1;
        while($i < count($subOrder)){
            if($order[$index] != $subOrder[$i])
                return false;
            $index++;
            $i++;
        }
        return true;
    }
    return false;
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

$pre = $in = [];

pre($root, $pre);
in($root, $in);

print_r($pre);
print_r($in);

$subRoot = new biTreeNode('b');
$subD = new biTreeNode('d');
$subE = new biTreeNode('e');
$subG = new biTreeNode('g');

$subRoot->lchild = $subD;
$subRoot->rchild = $subE;
$subE->lchild = $subG;

$subPre = $subIn = [];
pre($subRoot, $subPre);
in($subRoot,$subIn);

print_r($subPre);
print_r($subIn);

if(isSubTree($root, $subRoot))
    echo "true";
else
    echo "false";


function HasSubtree($pRoot1, $pRoot2)
{
    // write code here
    if($pRoot1 == null || $pRoot2 == null){
        return false;
    }
    return isSubtreeII($pRoot1,$pRoot2) || isSubtreeII($pRoot1->left,$pRoot2) || isSubtreeII($pRoot1->right,$pRoot2);
}
function isSubtreeII($pRoot1,$pRoot2){
    if($pRoot2 == null){
        return true;
    }
    if($pRoot2 == null){
        return false;
    }
    return $pRoot1->val == $pRoot2->val && isSubtreeII($pRoot1->left,$pRoot2->left) && isSubtreeII($pRoot1->right,$pRoot2->right);
}