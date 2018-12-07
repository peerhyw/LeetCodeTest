<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-15
 * Time: 下午8:00
 */

namespace Ces\Coroutine;


class Signal {
    const TASK_SLEEP = 1;
    const TASK_AWAKE = 2;
    const TASK_CONTINUE = 3;
    const TASK_KILLED = 4;
    const TASK_RUNNING = 5;
    const TASK_WAIT = 6;
    const TASK_DONE = 7;

    public static function isSignal($signal){
        if(!isset($signal)){
            return false;
        }

        if(!is_int($signal)){
            return false;
        }

        if($signal < 1 || $signal > 7){
            return false;
        }

        return true;
    }
}