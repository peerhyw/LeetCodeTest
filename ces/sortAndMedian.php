<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-26
 * Time: 下午8:13
 */


//选出小的往前交换
function bubbleSortPosiI($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $flag = 0;
        for($j = $count - 1; $j > $i; $j--){
            if($arr[$j] < $arr[$j-1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j-1];
                $arr[$j-1] = $temp;
                $flag = 1;
            }
        }
        if($flag == 0)
            break;
    }
    return $arr;
}

//选出大的往后交换
function bubbleSortPosiII($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $flag = 0;
        for($j = 0; $j < $count - $i -1; $j++){
            if($arr[$j] > $arr[$j+1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
                $flag = 1;
            }
        }
        if($flag == 0)
            break;
    }
    return $arr;
}

//选出大的往前交换
function bubbleSortNegaI($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $flag = 0;
        for($j = $count - 1; $j > $i; $j--){
            if($arr[$j] > $arr[$j-1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j-1];
                $arr[$j-1] = $temp;
                $flag = 1;
            }
        }
        if($flag == 0)
            break;
    }
    return $arr;
}

//选出小的往后交换
function bubbleSortNegaII($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $flag = 0;
        for($j = 0; $j < $count - $i - 1; $j++){
            if($arr[$j] < $arr[$j+1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
                $flag = 1;
            }
        }
        if($flag == 0)
            break;
    }
    return $arr;
}

function insertSortPosi($arr){
    $count = count($arr);
    for($i = 1; $i < $count; $i++){
        $temp = $arr[$i];
        $j = $i - 1;
        while($j >= 0 && $arr[$j] > $temp){
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        $arr[$j+1] = $temp;
    }
    return $arr;
}

function insertSortNega($arr){
    $count = count($arr);
    for($i = 1; $i < $count; $i++){
        $temp = $arr[$i];
        $j = $i - 1;
        while($j >= 0 && $arr[$j] < $temp){
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        $arr[$j+1] = $temp;
    }
    return $arr;
}

function selectSortPosi($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $minIndex = $i;
        for($j = $i + 1; $j < $count; $j++){
            if($arr[$j] < $arr[$minIndex]){
                $minIndex = $j;
            }
        }
        $temp = $arr[$i];
        $arr[$i] = $arr[$minIndex];
        $arr[$minIndex] = $temp;
    }
    return $arr;
}

function selectSortNega($arr){
    $count = count($arr);
    for($i = 0; $i < $count; $i++){
        $maxIndex = $i;
        for($j = $i+1; $j < $count; $j++){
            if($arr[$j] > $arr[$maxIndex]){
                $maxIndex = $j;
            }
        }
        $temp = $arr[$i];
        $arr[$i] = $arr[$maxIndex];
        $arr[$maxIndex] = $temp;
    }
    return $arr;
}

function halfSortPosi($arr){
    $count = count($arr);
    for($i = 1; $i < $count; $i++){
        $low = 0;
        $high = $i-1;
        while($low <= $high){
            $mid = intval(($low + $high) / 2);
            if($arr[$i] < $arr[$mid]){
                $high = $mid - 1;
            }
            if($arr[$i] >= $arr[$mid]){
                $low = $mid + 1;
            }
        }
        $temp = $arr[$i];
        for($j = $i; $j > $high + 1; $j--){
            $arr[$j] = $arr[$j-1];
        }
        $arr[$high+1] = $temp;
    }
    return $arr;
}

function halfSortNega($arr){
    $count = count($arr);
    for($i = 1; $i < $count; $i++){
        $low = 0;
        $high = $i - 1;
        while($low <= $high){
            $mid = intval(($low + $high) / 2);
            if($arr[$i] > $arr[$mid]){
                $high = $mid - 1;
            }
            if($arr[$i] <= $arr[$mid]){
                $low = $mid + 1;
            }
        }
        $temp = $arr[$i];
        for($j = $i; $j > $high + 1; $j--){
            $arr[$j] = $arr[$j-1];
        }
        $arr[$high+1] = $temp;
    }
    return $arr;
}

function shellSort($arr){
    $count = count($arr);
    for($increment = intval($count / 2); $increment > 0; $increment = intval($increment / 2)){
        for($i = $increment; $i < $count; $i++){
            $temp = $arr[$i];
            for($j = $i; $j >= $increment; $j -= $increment){
                if($temp < $arr[$j - $increment]){
                    $arr[$j] = $arr[$j - $increment];
                }else{
                    break;
                }
            }
            $arr[$j] = $temp;
        }
    }
    return $arr;
}

function quickSortPosi($arr, $low, $high){
    if($low < $high){
        $temp = $arr[$low];
        $i = $low;
        $j = $high;
        while($i != $j){
            while($j > $i && $arr[$j] > $temp){
                $j--;
            }
            if($i < $j){
                $arr[$i] = $arr[$j];
                $i++;
            }
            while($i < $j && $arr[$i] < $temp){
                $i++;
            }
            if($i < $j){
                $arr[$j] = $arr[$i];
                $j--;
            }
        }
        $arr[$i] = $temp;
        $arr = quickSortPosi($arr,$low,$i-1);
        $arr = quickSortPosi($arr,$i+1,$high);
        return $arr;
    }else{
        return $arr;
    }
}

function quickSortNega($arr,$low,$high){
    if($low < $high){
        $temp = $arr[$low];
        $i = $low;
        $j = $high;
        while($i != $j){
            while($j > $i && $arr[$j] < $temp){
                $j--;
            }
            if($i < $j){
                $arr[$i] = $arr[$j];
                $i++;
            }
            while($i < $j && $arr[$i] > $temp){
                $i++;
            }
            if($i < $j){
                $arr[$j] = $arr[$i];
                $j--;
            }
        }
        $arr[$i] = $temp;
        $arr = quickSortNega($arr,$low,$i - 1);
        $arr = quickSortNega($arr,$i + 1,$high);
        return $arr;
    }else{
        return $arr;
    }
}

$res = bubbleSortPosiI([4,3,3,1,5,6]);
$res = bubbleSortPosiII([4,3,3,1,5,6]);
$res = bubbleSortNegaI([4,3,3,1,5,6]);
$res = bubbleSortNegaII([4,3,3,1,5,6]);
$res = insertSortPosi([4,3,3,1,5,6]);
$res = insertSortNega([4,3,3,1,5,6]);
$res = selectSortPosi([4,3,3,1,5,6]);
$res = selectSortNega([4,3,3,1,5,6]);
$res = halfSortPosi([4,3,3,1,6,5]);
$res = halfSortNega([4,3,3,1,6,5]);
$res = shellSort([4,3,3,1,6,5,23,43,5,6,23]);
$res = quickSortPosi([4,3,3,1,6,5],0,5);
$res = quickSortNega([4,3,3,1,6,5],0,5);
print_r($res);