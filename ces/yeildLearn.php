<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-14
 * Time: 下午5:40
 */

function gen() {
    $ret = (yield 'a'); //1
    echo $ret;          //2
    $ret = (yield 'b'); //3
    echo $ret;          //4
}

$gen = gen();
$ret = $gen->current();     // current pointer: 1
var_dump($ret);             // current pointer: 1, print a
$ret = $gen->send("c\n");     // current pointer: 1, send: c, pointer => 2, print c, pointer => 3
var_dump($ret);             // current pointer: 3, print b
$ret = $gen->send("d\n");     // current pointer: 3, send: d, pointer => 4, print d, pointer => end
var_dump($ret);
echo "\n----------------------------------\n\n";

function gen1() {
    $ret = (yield 'a'); //1
    $ret = (yield 'b'); //2
}

$gen = gen();
// 如之前提到的在send之前, 当$gen迭代器被创建的时候一个renwind()方法已经被隐式调用
// 所以实际上发生的应该类似:
//$gen->rewind();
//var_dump($gen->send('something'));

//这样renwind的执行将会导致第一个yield被执行, 并且忽略了他的返回值.
//真正当我们调用yield的时候, 我们得到的是第二个yield的值! 导致第一个yield的值被忽略.
//string(3) "bar"
var_dump($gen->send('c'));
$ret = $gen->current();
var_dump($ret);
$ret = $gen->next();
$ret = $gen->current();
var_dump($ret);