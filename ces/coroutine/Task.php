<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-15
 * Time: 下午8:06
 */

namespace Ces\Coroutine;


class Task {
    protected $taskId = 0;
    protected $parentId = 0;
    protected $coroutine = null;
    //这里忽略了context 保存的是当前http请求的相关信息，可以通过系统调用的方式操作
    protected $context = null;
    protected $sendValue = null;
    protected $scheduler = null;
    protected $status = 0;

    public function __construct(\Generator $coroutine, $taskId = 0, $parentId = 0) {
        $this->coroutine = $coroutine;
        if(isset($GLOBALS['stTaskId']) && $taskId == 0){
            global $stTaskId;
            $taskId = $stTaskId++;
        }
        $this->taskId = $taskId;
        $this->parentId = $parentId;
        $this->scheduler = new Scheduler($this);
    }

    /**
     * 静态方法调用
     * @param $coroutine
     * @param int $taskId
     * @param int $parentId
     * @return Task
     */

    public static function execute($coroutine, $taskId = 0, $parentId = 0){
        if($coroutine instanceof \Generator){
            if(isset($GLOBALS['stTaskId']) && $taskId == 0){
                global $stTaskId;
                $taskId = $stTaskId++;
            }
            $task = new Task($coroutine, $taskId, $parentId);
            $task->run();
            return $task;
        }
        return $coroutine;
    }

    public function run(){
        while(true){
            try{
                if($this->status == Signal::TASK_KILLED){
                    $this->fireTaskDoneEvent();
                    break;
                }
                $this->status = $this->scheduler->schedule();

                //以下几种状态表示信号量，实际上已经从while里跳出来了。如果需要继续的话，会在其他地方重启。
                switch ($this->status){
                    case Signal::TASK_KILLED :
                    case Signal::TASK_SLEEP :
                    case Signal::TASK_WAIT :
                        return null;
                    case Signal::TASK_DONE :
                        $this->fireTaskDoneEvent();
                        return null;
                }
            }catch (\Exception $e){
                $this->scheduler->throwException($e);
            }
        }
    }

    public function send($value){
        $this->sendValue = $value;
        return $this->coroutine->send($value);
    }

    /**
     * @return int
     */
    public function getTaskId(): int {
        return $this->taskId;
    }

    /**
     * @return null
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @return null
     */
    public function getSendValue() {
        return $this->sendValue;
    }

    public function getResult(){
        return $this->sendValue;
    }

    /**
     * @return int
     */
    public function getStatus(): int {
        return $this->status;
    }

    /**
     * @return \Generator|null
     */
    public function getCoroutine() {
        return $this->coroutine;
    }

    /**
     * @param \Generator|null $coroutine
     */
    public function setCoroutine(\Generator $coroutine){
        $this->coroutine = $coroutine;
    }

    public function fireTaskDoneEvent(){
        echo "Task done $this->taskId";
    }
}