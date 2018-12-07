<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-1
 * Time: 下午11:55
 */

function scan($dir,$sorting_order = 0,&$tabIndex = 0){
    //echo "index: ".$tabIndex."\n";
    if(is_dir($dir)){
        $files = scandir($dir,$sorting_order);
        for($i = 2; $i < count($files); $i++){
            echo str_pad("",$tabIndex,"\t");
            echo $files[$i]."\n";
            if(is_dir($dir.'/'.$files[$i])){
                $tabIndex++;
            }
            scan($dir.'/'.$files[$i],$sorting_order,$tabIndex);
        }
        $tabIndex--;
    }/*else{
        echo $dir."\n";
    }*/
}

function scanII($dir){
    if(is_dir($dir)){
        $files = scandir($dir);
        for($i = 2; $i < count($files); $i++){
            if(is_dir($dir.'/'.$files[$i])){
                $files[$i] = scanII($dir.'/'.$files[$i]);
            }
        }
        return $files;
    }else{
        return null;
    }
}

function my_dir($dir) {
    $files = array();
    if(@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
        while(($file = readdir($handle)) !== false) {
            if($file != ".." && $file != ".") { //排除根目录；
                if(is_dir($dir."/".$file)) { //如果是子文件夹，就进行递归
                    $files[$file] = my_dir($dir."/".$file);
                } else { //不然就将文件的名字存入数组；
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
    }
}

//scan('../ces');
/*$files = scandir('./img');
var_dump($files);
var_dump(scandir($files[2]));*/
var_dump(is_dir('./img/abc'));

$res = my_dir('../ces');
$res = scanII('../ces');
print_r($res);