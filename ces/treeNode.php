<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-23
 * Time: 下午9:00
 */

class treeNode {
    public $value;
    public $childs = [];

    public function __construct($value) {
        $this->value = $value;
    }
}