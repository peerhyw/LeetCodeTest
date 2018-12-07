<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-8-19
 * Time: 上午1:40
 */
namespace a;

/*// Create cURL handles
$ch1 = curl_init("http://example.com/");

// Create a cURL multi handle
$mh = curl_multi_init();

// Add the handles to the multi handle
curl_multi_add_handle($mh, $ch1);

// Execute the multi handle
do {
    $status = curl_multi_exec($mh, $active);
    // Check for errors
    if($status > 0) {
        // Display error message
        echo "ERROR!\n " . curl_multi_strerror($status);
    }
} while ($status === CURLM_CALL_MULTI_PERFORM || $active);*/


$string = "a/b/c/d";
$matchs = explode("/",$string);
//echo count($matchs);
//var_dump($matchs);

preg_match_all('/<[^>]+>(.*)<\/[^>]+>/',
    "<b>example: </b>a<div align=left>this is a test</div>",
    $out, PREG_PATTERN_ORDER);
//var_dump($out[0]);

$a;
//echo var_export(empty($a),true);

class Test
{
    private $str = "Say Hello";
    public function onAfter()
    {
        echo $this->str; // 输出”Say Hello“
    }
}

$test = new Test();
swoole_timer_after(1000, array($test, "onAfter")); // 成员变量

swoole_timer_after(2000, function() use($test){ // 闭包
    $test->onAfter(); // 输出”Say Hello“
});

$a = [1,2];
$c = $a;
debug_zval_dump($c);
$b = &$a; //硬拷贝
print_r($a);
print_r($b);
print_r($c);

$b[] = 3;
print_r($a);
print_r($b);
print_r($c);

debug_zval_dump($a);
debug_zval_dump($c);