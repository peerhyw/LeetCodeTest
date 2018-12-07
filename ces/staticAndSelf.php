<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-13
 * Time: 下午9:27
 */
class A {

    public function __construct() {

    }

    private function foo() {
        echo "success!\n";
    }

    //静态方法和属性是以类作为作用域的函数。
    //静态方法不能访问这个类中的普通属性，因为那些属性属于一个对象，但可以访问静态属性。
    //如果修改了一个静态属性，那么这个类的所有实例都能访问到这个新值。
    //静态方法不能调用非静态属性。因为非静态属性需要实例化后，存放在对象里；self
    public function test() {
        $this->foo();
        static::foo();  //（后期静态绑定）谁继承 指向谁（实时调用的类） 然后在A的上下午中调用指向的子类的foo()方法 子类没有foo()方法就调用父类的
    }
}

class B extends A {
    /* foo() will be copied to B, hence its scope will still be A and
     * the call be successful */
}

class C extends A {
    private function foo() {
        echo "a\n";
        /* original method is replaced; the scope of the new one is C */
    }
}

$b = new B();
$b->test();
$c = new C();
//$c->test();   //fails

abstract class DomainObject {
    private $group;

    public function __construct() {
        $this->group = static::getGroup();
    }

    public static function create() {
        return new static();
    }

    static function getGroup() {
        return "default";
    }
}

class User extends DomainObject {

}

class Document extends DomainObject {
    static function getGroup() {
        return "document";
    }
}

class SpreadSheet extends Document {

}

print_r(User::create());
print_r(SpreadSheet::create());