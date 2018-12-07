<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-20
 * Time: 下午3:59
 */

class biTreeNode{
    public $value = null;
    public $lchild = null;
    public $rchild = null;

    public function __construct($value = null) {
        if($value != null){
            $this->value = $value;
        }
    }

    public function __destruct() {
        // TODO: Implement __destruct() method.
        $this->value = null;
        $this->lchild = null;
        $this->rchild = null;
    }
}