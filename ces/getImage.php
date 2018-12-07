<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-30
 * Time: 上午2:40
 */
function img($url){
    $string = file_get_contents($url);
    preg_match_all('/<\s*img[^src]*src\s*=\s*"([^"]*)"/',$string,$matchs);
    var_dump($matchs);
    foreach ($matchs[1] as $key => $imgsrc) {
        $path = explode("/",$imgsrc);
        echo $imgsrc."\n";
        var_dump($path);
        $img = file_get_contents($imgsrc);
        echo "path: ".$path[count($path)-1]."\n";
        if(!is_dir('./img'))
            mkdir('./img');
        file_put_contents("./img/".$path[count($path)-1],$img);
    }
}

img("https://www.baidu.com");