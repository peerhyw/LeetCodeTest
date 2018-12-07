<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-15
 * Time: 下午10:35
 */

namespace Ces\Coroutine;

function autoload($classname) {
    $classname = substr($classname,strrpos($classname,'\\')+1);
    $filename = $classname .".php";
    if(file_exists($filename)){
        include_once($filename);
    }else{
        echo 'class_file '.$filename.' not found!';
    }
}

spl_autoload_register('Ces\Coroutine\autoload');

//require 'Task.php' ;


/**
 * @function taskSleep
 * @param $ms
 * @return SysCall
 */
function taskSleep($ms){
    return new SysCall(function (Task $task) use ($ms){
        swoole_timer_after($ms, function () use ($task){
            $task->send("this is send value in sleep function.");
            $task->run();
        });
        return Signal::TASK_SLEEP;
    });
}

/**
 * @function delay
 * @return \Generator
 */
function delay(){
    echo "delay before\n";
    yield taskSleep(2000);
    echo "delay after\n";
}

/**
 * @function gen
 * @return \Generator
 */
function gen(){
    echo "gen1\n";
    yield 1;
    echo "gen2\n";
    yield 2;
    echo "gen3\n";
    yield 3;
}

//(new Task(delay(), 1))->run();
//(new Task(gen(), 2))->run();

/**
 * @function justReturnValue
 */
function justReturnValue(){
    yield(delay());
    echo "b------\n";
    yield 'yield value 2';

    /*yield 'yield value 2';
    echo "b------\n";
    yield(delay());*/
}

function gen1(){
    $ret1 = (yield "yield value 1");
    echo "[ret] $ret1\n";
    echo "a-------\n";
    $ret2 = (yield justReturnValue());
    echo "[ret] $ret2\n";
}

(new Task(gen1(),3))->run();

