<?php
/**
 * Created by PhpStorm.
 * User: peer
 * Date: 18-11-17
 * Time: 上午12:27
 */

namespace Ces\Coroutine;

class CoSocket {
    protected $socket;

    public function __construct($socket) {
        $this->socket = $socket;
    }

    public function accept(){
        //等待本socket就绪
        yield waitForRead($this->socket);
        //就绪以后会继续走到这里 返回给外层一个客户端连接socket
        yield stream_socket_accept($this->socket, 0);
    }

    public function read($size){
        //等待本socket就绪
        yield waitForRead($this->socket);
        //就绪以后回把读取到的内容 返回给外层
        yield fread($this->socket, $size);
    }

    public function write($string){
        //等待本socket就绪
        yield waitForWrite($this->socket);
        //就绪以后把响应写给客户端
        fwrite($this->socket, $string);
    }

    public function close(){
        @fclose($this->socket);
    }
}

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

$waitingForRead = [];
$waitingForWrite = [];

function waitForRead($socket){
    return new SysCall(function (Task $task) use ($socket){
        global $waitingForRead;
        if(isset($waitingForRead[(int) $socket])){
            $waitingForRead[(int) $socket][1][] = $task;
        }else{
            $waitingForRead[(int) $socket] = [$socket, [$task]];
        }
        //设置完了不让他往下走
        return Signal::TASK_WAIT;
    });
}

function waitForWrite($socket){
    return new SysCall(function (Task $task) use ($socket){
        global $waitingForWrite;
        if(isset($waitingForWrite[(int) $socket])){
            $waitingForWrite[(int) $socket][1][] = $task;
        }else{
            $waitingForWrite[(int) $socket] = [$socket, [$task]];
        }
        //设置完了不让他往下走
        return Signal::TASK_WAIT;
    });
}

function ioPoll($timeout){
    global $waitingForRead;
    global $waitingForWrite;

    $rSocks = [];
    foreach ($waitingForRead as list($socket)){
        $rSocks[] = $socket;
    }

    $wSocks = [];
    foreach ($waitingForWrite as list($socket)){
        $wSocks[] = $socket;
    }

    $eSocks = []; //dummy
    //stream_select 方法会直接修改入参 只保留就绪的socket数组
    if(false === stream_select($rSocks, $wSocks, $eSocks, $timeout)){
        return;
    }

    foreach ($rSocks as $socket){
        list(,$tasks) = $waitingForRead[(int) $socket];
        unset($waitingForRead[(int) $socket]);

        foreach ($tasks as $task){
            $task->send("ready for read");
            $task->run();
        }
    }

    foreach ($wSocks as $socket){
        list(,$tasks) = $waitingForWrite[(int) $socket];
        unset($waitingForWrite[(int) $socket]);

        foreach ($tasks as $task){
            $task->send("ready to write");
            $task->run();
        }
    }
}

function ioPollTask(){
    global $waitingForRead;
    global $waitingForWrite;
    while(true){
        if(count($waitingForRead) <= 1 && count($waitingForWrite) <= 1){
            //如果等待检查的socket只有1个 则用阻塞的方式等待
            ioPoll(null);
        }else{
            //否则设为0超时
            ioPoll(0);
        }
        yield;
    }
}

function handleClient(CoSocket $socket){
    $data = (yield $socket->read(8192));
    $msg = "Received following request:\n\n$data";
    $msgLength = strlen($msg);

    //响应报文由状态行(HTTP版本、状态码)+HTTP首部字段(响应首部字段、通用首部字段、实体首部字段)组成。
    //空行(CR+LF)分隔首部与报文主体。所以这里留个空行在打印$msg
    $response = <<<RES
HTTP/1.1 200 OK\r
Content-Type: text/plain\r
Content-Length: $msgLength\r
Connection: close\r
\r
$msg
RES;
    yield $socket->write($response);
    yield $socket->close();
}

static $stTaskId = 1;

function server($port){
    echo "Staring server at port $port...\n";
    //这里抛出的异常会被scheduler和task抛来抛去 最后还是到这里catch一下
    try {
        $socket = @stream_socket_server("tcp://localhost:$port", $errNo, $errStr);
        if (!$socket)
            throw new Exception($errStr, $errNo);//设置为读写非阻塞
        stream_set_blocking($socket, 0);
        $socket = new CoSocket($socket);
        while (true) {
            $clientSocket = (yield $socket->accept());
            $clientCoSocket = new CoSocket($clientSocket);
            //为新的链接创建Task
            Task::execute(handleClient($clientCoSocket));
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

//创建服务端socket的task 1
Task::execute(server(8080));
//不断刷新socket_select的task 2
Task::execute(ioPollTask());