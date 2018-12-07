<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-15
 * Time: 下午8:52
 */

namespace Ces\Coroutine;


class Scheduler {
    private $task = null;
    private $stack = null;

    public function __construct(Task $task) {
        $this->task = $task;
        $this->stack = new \SplStack();
    }

    public function schedule(){
        $coroutine = $this->task->getCoroutine();
        $value = $coroutine->current();

        $signal = $this->handleSysCall($value);
        if($signal !== null)
            return $signal;

        $signal = $this->handleSubCoroutine($value);
        if($signal !== null)
            return $signal;

        $signal = $this->handleYieldValue($value);
        if($signal !== null)
            return $signal;

        $signal = $this->handleTaskStack($value);
        if($signal !== null)
            return $signal;

        $signal = $this->checkTaskDone($value);
        if($signal !== null)
            return $signal;

        return Signal::TASK_DONE;
    }

    public function isStackEmpty(){
        return $this->stack->isEmpty();
    }

    public function throwException($e, $isFirstCall = false){
        if($this->isStackEmpty()){
            $this->task->getCoroutine()->throw($e);
            return;
        }

        try {
            if ($isFirstCall) {
                $coroutine = $this->task->getCoroutine();
            } else {
                $coroutine = $this->stack->pop();
            }
            $this->task->setCoroutine($coroutine);
            $coroutine->throw($e);
            $this->task->run();
        } catch (\Exception $e) {
            $this->throwException($e);
        }
    }

    /**
     * 处理系统调用
     * @param $value
     * @return mixed|null
     */
    private function handleSysCall($value){
        if(!($value instanceof SysCall) && !is_subclass_of($value, SysCall::class)){
            return null;
        }
        echo $this->task->getTaskId()."| SYSCALL\n";

        //走系统调用 实际上因为__invoke 走的是 $value($this->task);
        $signal = call_user_func($value,$this->task);
        if(Signal::isSignal($signal)){
            return $signal;
        }

        return null;
    }

    /**
     * 处理子协程
     * @param $value
     * @return int|null
     */
    private function handleSubCoroutine($value){
        if(!($value instanceof \Generator)){
            return null;
        }
        echo $this->task->getTaskId()."| COROUTINE\n";

        //获取当前的协程 入栈
        $coroutine = $this->task->getCoroutine();
        $this->stack->push($coroutine);
        //将新的协程设为当前的协程
        $this->task->setCoroutine($value);

        return Signal::TASK_CONTINUE;
    }

    /**
     * 处理协程栈
     * @param $value
     * @return int|null
     */
    private function handleTaskStack($value){
        //能够跑到这里说明当前协程已经跑完了 valid()==false了 需要看下栈里是否还有以前的协程
        if($this->isStackEmpty()){
            return null;
        }

        echo $this->task->getTaskId()."| TASKSTACK\n";
        //出栈 设置为当前运行的协程
        $coroutine = $this->stack->pop();
        $this->task->setCoroutine($coroutine);

        //这个sendvalue可能是从刚跑完的协程那里得到的 把它当做send值传给老协程 让他继续跑
        $value = $this->task->getSendValue();
        $this->task->send($value);

        return Signal::TASK_CONTINUE;
    }

    /**
     * 处理普通的yield值
     * @param $value
     * @return int|null
     */
    private function handleYieldValue($value){
        $coroutine = $this->task->getCoroutine();
        if(!$coroutine->valid()){
            return null;
        }
        echo $this->task->getTaskId()."| YIELD VALUE\n";

        //如果协程后面没有yield了 这里发出send以后valid就变成false了 并且current变成NULL
        $status = $this->task->send($value);
        return Signal::TASK_CONTINUE;
    }

    private function checkTaskDone($value){
        $coroutine = $this->task->getCoroutine();
        if($coroutine->valid()){
            return null;
        }
        echo $this->task->getTaskId()."| CHECKDONE\n";

        return Signal::TASK_DONE;
    }
}