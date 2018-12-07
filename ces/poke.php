<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-10-30
 * Time: 下午8:16
 */
function poke(){
    $poke = [];
    $poke[0][0] = 54;
    for($i = 1; $i<=4; $i++){
        for($j = 1;$j <= 13; $j++){
            $poke[$i][$j] = $j;
        }
    }
    $poke[$i][0] = "black joker";
    $poke[$i][1] = "red joker";
    return $poke;
}

function randomFive():array {
    $randomFive = [];
    for($i = 0; $i < 5; $i++){
        $m = random_int(1,5);
        if($m == 5){
            $n = random_int(0,1);
            $n = ($n == 0 ? 'black joker' : 'red joker');
        }else{
            $n = random_int(1,13);
        }
        if(in_array([$m,$n],$randomFive)){
            $i--;
        }else{
            $randomFive[$i][0] = $m;
            $randomFive[$i][1] = $n;
        }
    }
    return $randomFive;
}

function checkSuccessive(array $check){
    $isSame = array_column($check,0);
    if(count(array_count_values($isSame)) != 1){
        throw new Exception("不是顺子");
    }

    $successive = array_column($check,1);
    if(count(array_count_values($successive)) != 5){
        throw new Exception("存在重复牌");
    }

    sort($successive);
    if($successive[4]-$successive[0] != 4){
        throw new Exception("不是顺子");
    }
    return true;
}

//randomFive();
$test = [[1,1],[1,3],[1,5],[1,4],[1,2]];
try{
    //if(checkSuccessive($test))
    //    echo "顺子";
    $randomFive = randomFive();
    print_r($randomFive);
    checkSuccessive($randomFive);
}catch (Exception $e){
    echo $e->getMessage();
}