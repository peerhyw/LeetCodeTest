<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-27
 * Time: 下午6:27
 */

function isMatrix($matrix){
    if(!is_array($matrix))
        return false;
    $col = count($matrix[0]);
    for($i = 1; $i < count($matrix); $i++){
        if(count($matrix[$i]) != $col)
            return false;
        for($j = 0; $j < $col; $j++){
            if(is_array($matrix[$i][$j]))
                return false;
        }
    }
    return true;
}

function inMatrix($matrix,$value){
    if(!isMatrix($matrix)){
        return false;
    }
    $res = [];
    for($i = 0; $i < count($matrix); $i++){
        for($j = 0; $j < count($matrix[0]); $j++){
            if($matrix[$i][$j] == $value)
                $res[] = [$i,$j];
        }
    }
    return $res;
}

//写得太脑残了
function findRouteDefective($matrix,$start,$destination,$i,$j,$include,$temp = []){
    if($start == $destination){
        $temp[] = $destination;
        return $temp;
    }else{
        $temp[] = $start;
        $include[$i][$j] = 1;
        $up = $i - 1;
        $down = $i + 1;
        $left = $j - 1;
        $right = $j + 1;
        //print_r($temp);
        if($up >= 0 && $include[$up][$j] == 0){
            $temp = findRouteDefective($matrix,$matrix[$up][$j],$destination,$up,$j,$include,$temp);
        }
        if($temp[count($temp)-1] != $destination && $down <= count($matrix)-1 && $include[$down][$j] == 0){
            $temp = findRouteDefective($matrix,$matrix[$down][$j],$destination,$down,$j,$include,$temp);
        }
        if($temp[count($temp)-1] != $destination && $left >= 0 && $include[$i][$left] == 0){
            $temp = findRouteDefective($matrix,$matrix[$i][$left],$destination,$i,$left,$include,$temp);
        }
        if($temp[count($temp)-1] != $destination && $right <= count($matrix[$i])-1 && $include[$i][$right] == 0){
            $temp = findRouteDefective($matrix,$matrix[$i][$right],$destination,$i,$right,$include,$temp);
        }
        if($temp[count($temp)-1] != $destination){
            array_pop($temp);
        }
        return $temp;
    }
}

//正确的解法 花了我一天的时间 草
function findRoute($matrix,$route,$start_i,$start_j,$include,&$res,$temp = [],$routeBegin = 0){
    if($routeBegin <= strlen($route) - 1){
        $start = $matrix[$start_i][$start_j];
        $destination = $route[strlen($route)-1];
        if($start == $destination){
            $temp[] = [$destination,$start_i,$start_j];
            $res[] = $temp;
        }else {
            $temp[] = [$start,$start_i,$start_j];
            $include[$start_i][$start_j] = 1;
            $up = $start_i - 1;
            $down = $start_i + 1;
            $left = $start_j - 1;
            $right = $start_j + 1;
            if ($up >= 0 && $matrix[$up][$start_j] == $route[$routeBegin + 1]
                && $include[$up][$start_j] == 0) {

                findRoute($matrix, $route, $up, $start_j, $include, $res, $temp, $routeBegin + 1);
            }
            if ($down <= count($matrix)-1 && $matrix[$down][$start_j] == $route[$routeBegin + 1]
                && $include[$down][$start_j] == 0) {

                findRoute($matrix, $route, $down, $start_j ,$include, $res, $temp, $routeBegin + 1);
            }
            if ($left >= 0 && $matrix[$start_i][$left] == $route[$routeBegin + 1]
                && $include[$start_i][$left] == 0) {

                findRoute($matrix, $route, $start_i, $left, $include, $res, $temp, $routeBegin + 1);
            }
            if ($right <= count($matrix[0]) - 1 && $matrix[$start_i][$right] == $route[$routeBegin + 1]
                && $include[$start_i][$right] == 0) {

                findRoute($matrix, $route, $start_i, $right, $include, $res, $temp, $routeBegin + 1);
            }
            $include[$start_i][$start_j] = 0;
            array_pop($temp);
        }
    }

}

function initInclude($row,$col){
    if($row < 0 || $col < 0)
        return false;
    $include = [];
    for($i = 0; $i < $row; $i++){
        for($j = 0; $j < $col; $j++){
            $include[$i][$j] = 0;
        }
    }
    return $include;
}

function routeInMatrix($matrix,$route) {
    $start = inMatrix($matrix,$route[0]);
    if($start){
        $include = initInclude(count($matrix),count($matrix[0]));
        $res = [];
        for($i = 0; $i < count($start); $i++){
            $resItem = [];
            findRoute($matrix, $route, $start[$i][0], $start[$i][1], $include, $resItem);
            if($resItem)
                $res[] =$resItem;
            $include = initInclude(count($matrix),count($matrix[0]));
        }
        return $res;
    }
    return false;
}

$matrix = [['e','c','c','e'],
           ['s','f','c','s'],
           ['a','d','e','e']];
$res = routeInMatrix($matrix,'cce');

$matrixII = [['a','b','c','e'],
             ['s','f','c','s'],
             ['a','d','e','e']];
$resII = routeInMatrix($matrixII,'abcd');
if(!$resII)  //if(!null) => true / if(null) => false
    echo "no\n";


foreach ($res as $start){
    echo 'start: '.$start[0][0][0].' ['.$start[0][0][1].','.$start[0][0][2].']'.PHP_EOL;
    foreach ($start as $key => $route){

        echo "route ".($key + 1).": ";
        foreach ($route as $node){
            //print_r($node);
            echo "$node[0][$node[1],$node[2]] " ;
        }
        echo PHP_EOL;
    }
    echo PHP_EOL;
}