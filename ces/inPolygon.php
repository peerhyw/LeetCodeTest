<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-9
 * Time: 下午9:24
 */

function check(Array $pointArr,Array $point) {
    $oddNodes = false;
    $x = $point[0];
    $y = $point[1];
    for($i = 0,$j = count($pointArr)-1; $i < count($pointArr); $j = $i++){
        echo "j: ".$j." -> i: ".$i."\n";
        $x_i = $pointArr[$i][0];
        $y_i = $pointArr[$i][1];
        $x_j = $pointArr[$j][0];
        $y_j = $pointArr[$j][1];

        echo "x_i: ".$x_i." y_i: ".$y_i." x_j: ".$x_j." y_j: ".$y_j."\n";

        //只考察点左侧的边
        if(($y_i < $y && $y_j >= $y) || ($y_j < $y && $y_i >= $y))
        /*
         j->i
             /i                       /j
         y -----------------------------------------------------------------
            /   => /i(=)             /  =>  /j(=)
           j      /   y_j<y<=y_i    i      /      y_i<y<=y_j
                 j                        i
        */
            echo "true a"."\t";

        if($x_i <= $x || $x_j <= $x)
            //只在点的左侧的边
            echo "true b"."\n";

        if((($y_i < $y && $y_j >= $y) || ($y_j < $y && $y_i >= $y)) && ($x_i <= $x || $x_j <= $x)){
            $x_ji = $x_i + (($x_j - $x_i) / ($y_j - $y_i)) * ($y - $y_i);
            echo "x_ji: ".sprintf("%.2f",$x_ji)." x: ".$x."\n";
            if($x_ji < $x){
                echo "oddNodes before: ".var_export($oddNodes, true)."\t";
                $oddNodes = !$oddNodes;
                echo "oddNodes after: ".var_export($oddNodes, true)."\n";
            }
        }
        echo "\n";
    }
    return $oddNodes;
}



$pointArr = [[1,1],[-1,1],[-1,-1],[1,-1]];
$pointArr1 = [[2,1],[0,2],[-2,1],[-1,-1],[1,-1]];
$pointArr2 = [[4,0],[3,2],[2,1],[1,3],[0,0],[-1,4],[-2,0],[-3,-2],[5,-4]];
$point = [3,-2];
if(check($pointArr2,$point))
    echo "true";
else
    echo "false";
