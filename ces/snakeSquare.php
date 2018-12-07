<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-13
 * Time: 上午12:16
 */

function snakeSquare($row,$col){
    $res = [];
    $start = 1;
    $layer = intval(($row + 1) / 2);

    for($i = 1; $i <= $layer; $i++){
        $startx = $i - 1;
        $starty = $i - 1;
        $width = $col - $i + 1;
        $height = $row - $i + 1;

        //up
        for($u = $starty; $u < $width; $u++){
            $res[$startx][$u] = $start;
            $start += 1;
        }

        //right
        for($r = $startx + 1; $r < $height; $r++){
            $res[$r][$u-1] = $start;
            $start += 1;
        }

        //down
        for($d = $u - 1 - 1; $d >= $starty; $d--){
            $res[$r-1][$d] = $start;
            $start += 1;
        }

        //left
        for($l = $r - 1 - 1; $l >= $startx + 1; $l--){
            $res[$l][$d+1] = $start;
            $start += 1;
        }
    }

    for($i = 0; $i < $row; $i++){
        for($j = 0; $j < $col; $j++){
            echo $res[$i][$j]." ";
        }
        echo "\n";
    }
}

function snakeSquare_1($n){
    $rowStart = 0;
    $rowEnd = $n - 1;
    $colStart = 0;
    $colEnd = $n - 1;
    $counter = 0;
    $res = [];
    while($counter < $n*$n){

        //up
        for($i = $colStart; $i <= $colEnd; $i++){
            $res[$rowStart][$i] = ++$counter;
        }
        $rowStart++;

        //right
        for($i = $rowStart; $i <= $rowEnd; $i++){
            $res[$i][$colEnd] = ++$counter;
        }
        $colEnd--;

        //down
        for($i = $colEnd; $i >= $colStart; $i--){
            $res[$rowEnd][$i] = ++$counter;
        }
        $rowEnd--;

        //left
        for($i = $rowEnd; $i >= $rowStart; $i--){
            $res[$i][$colStart] = ++$counter;
        }
        $colStart++;
    }
    for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n; $j++){
            echo $res[$i][$j]." ";
        }
        echo PHP_EOL;
    }
}

snakeSquare(5,5);
snakeSquare_1(5);