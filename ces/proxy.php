<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-28
 * Time: 下午6:22
 */

interface InovationHandler{
    function invoke($method,array $arr_args);
}

final class Proxy{
    const CLASS_TEMPLATE = 'return new class($handler,$target) implements %s {
                                private $handler;
                                private $target;
                                public function __construct(InovationHandler $handler,$target){
                                    $this->handler = $handler;
                                    $this->target = $target;
                                }
                                %s
                            };';
    const FUNCTION_TEMPLATE = 'public function %s(%s){
                                   $args = func_get_args();
                                   $method = explode("::", __METHOD__);
                                   $this->handler->invoke(new ReflectionMethod($this->target,$method[1]),$args);
                               }';

    public static function newProxyInstance($target, array $interfaces, InovationHandler $handler){
          if(self::checkInterfaceExists($interfaces)){
              $code = self::generateClass($interfaces);
              return eval($code);
          }
          return false;
    }

    protected static function generateClass(array $interfaces){
        $interfaceList = implode(',',$interfaces);
        $funtionList = '';
        foreach ($interfaces as $interface){
            $class = new ReflectionClass($interface);
            $methods = $class->getMethods();
            foreach ($methods as $method){
                $parameters = [];
                foreach ($method->getParameters() as $parameter){
                    $parameters[] = '$'.$parameter->getName();
                }
                $funtionList .= sprintf(self::FUNCTION_TEMPLATE,$method->getName(),implode(',',$parameters));
            }
        }
        return sprintf(self::CLASS_TEMPLATE,$interfaceList,$funtionList);
    }

    public static function checkInterfaceExists(array $interfaces){
        foreach ($interfaces as $interface){
            if(!interface_exists($interface))
                return false;
        }
        return true;
    }
}

interface test1{
    public function t1($str);
}

interface test2{
    public function t2();
}

class testImpl implements test1,test2{
    public function t1($str) {
        // TODO: Implement t1() method.
        echo $str.PHP_EOL;
    }

    public function t2() {
        // TODO: Implement t2() method.
        echo "nothing has been passed in.\n";
    }
}

class handler implements InovationHandler {
    private $target;
    public function __construct($target) {
        $this->target = $target;
    }
    public function invoke($method, array $arr_args) {
        // TODO: Implement invoke() method.
        echo "pre operations\n";
        $method->invokeArgs($this->target,$arr_args);
        echo "post operations\n";
    }
}

$impl = new testImpl();
$proxy = Proxy::newProxyInstance($impl,['test1','test2'],new handler($impl));
$proxy->t1('test t1');
$proxy->t2();