<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-19
 * Time: 下午6:02
 */

require_once "biTreeNode.php";

//从以前c下仿写的
function rebuildBiTree($pre, $in, $preStart, $preEnd, $inStart, $inEnd){
    if($preStart > $preEnd)
        return null;
    for($i = $inStart; $i <= $inEnd; $i++){
        if($in[$i] == $pre[$preStart]){         //前序遍历序列第一个元素就是根节点
            $node = new biTreeNode($in[$i]);    //查找当前子树跟单节点在中序遍历序列中的位置
            break;
        }
    }
    //pre [h,....|...]  in[....,i,...]
    //        l    r         l     r
    $node->lchild = rebuildBiTree($pre, $in, $preStart + 1, $preStart + $i - $inStart, $inStart, $i - 1);
    $node->rchild = rebuildBiTree($pre, $in, $preStart + $i - $inStart + 1, $preEnd, $i + 1, $inEnd);
    return $node;
}

//php
function reConstructBiTree($pre, $in){
    if(count(array_diff($pre, $in)) != 0)
        return false;
    if($pre && $in) {
        $index = array_search($pre[0], $in);
        if ($index !== false) {
            $root = new biTreeNode($pre[0]);
            $root->lchild = reConstructBiTree(array_slice($pre, 1, $index), array_slice($in, 0, $index));
            $root->rchild = reConstructBiTree(array_slice($pre, $index + 1), array_slice($in, $index + 1));
            return $root;
        }
    }
}

$pre = ['a','b','d','e','g','c','f'];
$in = ['d','b','e','g','a','f','c'];
$inTmp = ['d','b','e','g','a','f','r'];
$biTree = rebuildBiTree($pre, $in, 0, count($pre) - 1, 0, count($in) - 1);
print_r($biTree);
$biTreeP = reConstructBiTree($pre, $inTmp);
var_dump($biTreeP);