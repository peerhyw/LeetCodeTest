<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-15
 * Time: 下午10:33
 */

namespace Ces\Coroutine;


class SysCall {
    protected $callback = null;

    public function __construct(\Closure $callback) {
        $this->callback = $callback;
    }

    public function __invoke(Task $task) {
        // TODO: Implement __invoke() method.
        return call_user_func($this->callback, $task);
    }
}