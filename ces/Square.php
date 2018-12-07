<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-29
 * Time: 下午11:16
 */
class Square{
    protected $points = [];

    public function __construct(array $points){
        $this->points = $points;
    }

    public function check() {
        $result = [];
        if(count($this->points) != 4)
            return false;
        for($i = 0;$i < count($this->points);$i++){
            for($j = $i+1 ; $j < count($this->points) ; $j++){
                $result[] = $this->calculate($i,$j);
            }
        }
        sort($result);
        print_r($result);
        if($result[0] == $result[1] && $result[4] == $result[5] && $result[4] > $result[0])
            echo "true";
        else
            echo "false";
    }

    public function calculate($i,$j){
        $a = pow(($this->points[$i][0] - $this->points[$j][0]),2);
        $b = pow(($this->points[$i][1] - $this->points[$j][1]),2);
        return $a + $b;
    }
}

$points = [[0, 0], [2, 0], [0, 1], [2, 1]];
$square = new Square($points);
$square->check();