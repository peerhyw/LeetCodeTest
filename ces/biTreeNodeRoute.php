<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-1
 * Time: 下午4:33
 */

require_once "biTreeNode.php";

function preOrderFind($node, $value, SplStack &$stack){
    if($node != null){
        echo "节点值: ".$node->value."\n";
        $stack->push($node);
        echo "入栈 count: ".$stack->count()."\n";
        if($node->value == $value){
            echo "找到了\n";
            echo "stack count: ".$stack->count()."\n";
            //var_dump($stack);
            $stackCount = $stack->count();
            for($i = 0; $i < $stackCount; $i++){  //while(!$stack->count())
                $pop = $stack->pop();
                echo "pop value: ".$pop->value."\n";
            }
            return true;
        }else{
            if($node->lchild == null && $node->rchild == null) {
                echo "叶子节点\n";
                $popValue = $stack->pop()->value;
                echo "出栈 count: ".$stack->count()."\n";
                echo "出栈 value: ".$popValue."\n";
            }else{
                echo "非叶子节点\n";
                echo "左子树\n";
                $flag = preOrderFind($node->lchild,$value,$stack);
                if(!$flag){
                    echo "进入右子树\n";
                    while($stack->top()->value != $node->value){
                        $stack->pop();
                    }
                    return preOrderFind($node->rchild,$value,$stack);
                }
            }
        }
    }
    return false;
}

$root = new biTreeNode(8);
$rootl = new biTreeNode(3);
$rootr = new biTreeNode(10);
$root->lchild = $rootl;
$root->rchild = $rootr;
$rootll = new biTreeNode(1);
$rootlr = new biTreeNode(6);
$rootl->lchild = $rootll;
$rootl->rchild = $rootlr;
$rootlrl = new biTreeNode(4);
$rootlrr = new biTreeNode(7);
$rootlr->lchild = $rootlrl;
$rootlr->rchild = $rootlrr;
$rootrr = new biTreeNode(14);
$rootrrl = new biTreeNode(13);
$rootr->rchild = $rootrr;
$rootrr->lchild = $rootrrl;

//var_dump($root);
$stack = new SplStack();
preOrderFind($root,7,$stack);
//var_dump($stack);

