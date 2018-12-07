<?php

$a = 'abc';
$b = 'bad';
//$c = $a.$b;
//$d = str_replace('b','',$c);
//echo $d;

$a = 123;
print_r(array((string)$a));
var_dump(strval($a));


echo round((float)(5/3),2);

$ces = [1,2,3];
print_r($ces);
$ces[count($ces)-1] = null;
print_r($ces);
echo count($ces);

echo "t: ".intval('+1354asdfsaf sdfa2151').PHP_EOL;

interface test{
    public function test();
}

//echo var_export(interface_exists('test'),true).PHP_EOL;

$arr = array(1,2,3);
foreach($arr as &$val) {
    $val += $val % 2 ? $val++ : $val--;
}
//$val=10;
//print(join('',$arr));

if(0.1+0.7 === 0.8)
    echo "true\n";
else
    echo "false\n";

$a = (0.01+0.57)*100;
echo intval((0.7999)*10);
//var_dump($a);
//var_dump(intval($a));
echo intval((0.01+0.09)*10);

echo (-10)%3;

$x = 2;
echo $x == 2 ? '我' : $x == 1 ? '你' : '它';
   // true ? 'me' : false ? 'you' : 'it'
   // (true ? 'me' : false) ? 'you' : 'it'  => 'you'


if($a = 100 && $b = 200) { //&& prior to =
    var_dump($a,$b);
}

$i = 111;
var_dump(printf("%d",$i)); //printf 返回i的位数 return num of digits
printf("%d",printf("%d",$i));

$a = 3;
$b = 5;
if ($a = 3 || $b = 7)  { // $a = (3 || $b = 7)  3 || $b =7 ||的前半部分已经为true 就不执行后半部分（$b = 7）了 故 $b还是为5
    $a++;                // 改为 && $b就会被赋值为7在进行自加
    $b++;
}
var_dump($a,$b);

$today = date('Y-m-d',time());
$tomorrow = date('Y-m-d',time()+60*60*24);

echo "today: $today\n";
echo "tomorrow: $tomorrow\n";

$today = '2018-11-30';
$tomorrow = '2018-12-01';
echo (strtotime($tomorrow) - strtotime($today)) / 60 / 60 / 24;

echo LOCK_EX | LOCK_NB;

echo __FILE__.PHP_EOL;
echo __DIR__.PHP_EOL;


$a = [1,2];
$b = &$a;
$c = $a; //硬拷贝
print_r($a);
print_r($b);
print_r($c);
debug_zval_dump($c);

$b[] = 3;
print_r($a);
print_r($b);
print_r($c);

debug_zval_dump($a);
debug_zval_dump($c);

//setcookie("user","value");
//var_dump($_COOKIE['user']);

$a = 3;
echo "$a"+"$a";

$string = 'waiting for you 等wait你back';
echo strlen($string).PHP_EOL;
for($i = 0; $i < strlen($string); $i+=2){
    //echo substr($string,$i,2).PHP_EOL;
}

function GBsubstr($string, $start, $length) {
    if(strlen($string) > $length){
        $str = '';
        $len = $start + $length;
        for($i = $start;$i < $len;$i++){
            if(ord(substr($string,$i,1)) > 0xa0){
                echo "b\n";
                $str .= substr($string,$i,2);
                echo $str.PHP_EOL;
                $i++;
            }else{
                echo "a\n";
               $str .= substr($string,$i,1);
               echo $str.PHP_EOL;
            }
        }
        return $str.'...';
    }else{
        return $string;
    }
}

echo GBsubstr($string,0,19).PHP_EOL;
echo mb_substr('这样一来我的字符串就不会有乱码^_^', 0, 7, 'utf-8').PHP_EOL;
echo mb_strcut('这样一来我的字符串就不会有乱码^_^', 0, 7, 'utf-8').PHP_EOL;
//mb_substr是按字来切分字符，而mb_strcut是按字节来切分字符，但是都不会产生半个字符的现象

//print_r($_SERVER);

/*$config = [
    "travel" => drive::class,
];

$travel = new $config["travel"](60,1000);
$xiaoming = new human($travel);
$xiaoming->traveling();*/

echo '\n';
echo stripcslashes('\n');
echo stripslashes('\n');
echo stripslashes("\n");

echo __DIR__;

$note=<<<XML
<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder1</heading>
<heading>Reminder2</heading>
<body>Don't forget me this weekend!</body>
</note>
XML;

$xml=new SimpleXMLElement($note);
$xml->addChild("type","private");
$xml->type->addChild("date","2013-01-01");

echo $xml->asXML();

function calltmback($a, callable $callback){
    $b = 2;
    return $callback($a,$b);
}

$sum = calltmback(1,function ($a,$b){
    return $a+$b;
});
echo $sum.PHP_EOL;

$example = function ($message){
    echo $message.PHP_EOL;
};
$example('abc');

$message = 'edf';
$exampleII = function () use ($message){
    echo $message.PHP_EOL;
};

$exampleII();