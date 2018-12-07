<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-23
 * Time: 下午9:00
 */

require_once "treeNode.php";

function route($node, $target, &$route, $temp = []){
    if($node == $target){
        $temp[] = $target->value;
        $route = $temp;
    }else{
        if($node->childs != null){
            for($i = 0; $i < count($node->childs); $i++){
                $temp[] = $node->value;
                route($node->childs[$i],$target,$route,$temp);
                array_pop($temp);
            }
        }
    }
}

function commonRoot($root, $nodeA, $nodeB){
    $routeA = [];
    $routeB = [];
    route($root,$nodeA,$routeA);
    route($root,$nodeB,$routeB);

    if ($routeA != null && $routeB != null){
        $i = count($routeA) - 1;
        $j = count($routeB) - 1;
        while($i >= 0 && $j >= 0){
            if($routeA[$i] == $routeB[$j]){
                return $routeA[$i];
            }
            $i--;
            $j--;
        }
    }
    return null;

}

$root = new treeNode('a');
$b = new treeNode('b');
$c = new treeNode('c');
$d = new treeNode('d');
$e = new treeNode('e');
$f = new treeNode('f');
$g = new treeNode('g');
$h = new treeNode('h');
$i = new treeNode('i');

$root->childs = [$b,$c,$d];
$b->childs = [$e,$f];
$c->childs = [$g,$h,$i];

/*$route = [];
route($root,$g,$route);
print_r($route);*/

echo commonRoot($root,$i,$g);