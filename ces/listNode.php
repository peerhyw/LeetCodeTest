<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 上午1:48
 */

class listNode{
    public $value;
    public $next = null;

    public function __construct($value) {
        $this->value = $value;
    }
}