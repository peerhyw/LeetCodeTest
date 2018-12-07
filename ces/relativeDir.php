<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-12-3
 * Time: 下午11:42
 */

$a = 'a/b/c/e.txt';
$b = 'a/b/f/g/x/d.txt';

$adir = explode('/',$a);
$bdir = explode('/',$b);

$i = 0;
while($adir[$i] == $bdir[$i]){
    $i++;
}
$temparrI = array_slice($bdir,0,count($bdir)-1);
$temparrII = array_fill(count($bdir)-1,count($bdir)-1-$i,'..');
$temparr = array_merge($temparrI,$temparrII);
$temparr = array_merge($temparr,array_slice($adir,$i));
$relativedir = implode('/',$temparr);
echo $relativedir.PHP_EOL;



