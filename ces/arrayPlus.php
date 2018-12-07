<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-4
 * Time: 下午10:33
 */
$a = [0,1,2,3];
$b = [1,2,'a'=>3,4,5,6,'a'];
$a+=$b;
//var_dump($a);

//$b会把比$a多出来的数字索引例如$b[4] $b[5]插入到$a 关联索引$b['a']也会插入到$a 而$a中的所有元素不被覆盖

$c = [1,2,3,4];
foreach ($c as &$v){
    echo $v;
}
echo PHP_EOL;
var_dump($c);
echo "final v: ".$v."\n";
$d = [5,6,7,8,9];
foreach ($d as $v){
    echo $v;
}
echo PHP_EOL;
var_dump($d);
var_dump($c);

$a = range(1,3);
foreach($a as &$b){
    $b *= $b;
}

foreach( $a as $b){
    echo  $b;
}