<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-30
 * Time: 下午5:57
 */
$db = new PDO("mysql:host=127.0.0.1:33060;dbname=test","root","root");
/*$sql = "select * from test where id=:id";
$id = 2;
$sth = $db->prepare($sql);
$sth->bindParam(':id',$id);
$sth->execute();
$res = $sth->fetch(PDO::FETCH_ASSOC);
//var_dump($res);*/

$sql = "select sql_calc_found_rows * from test limit 1";
$sth = $db->prepare($sql);
$sth->execute();
$res = $sth->fetch(PDO::FETCH_ASSOC);
var_dump($res);

$sqlII = "select found_rows()";
$sthII = $db->prepare($sqlII);
$sthII->execute();
$resII = $sthII->fetch(PDO::FETCH_NUM);
echo $resII[0].PHP_EOL;
print_r($resII);
