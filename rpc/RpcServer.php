<?php
#使用select模型
class RpcServer{

	private $server;
	private $read_arr = [];
	private $write_arr = [];
	private $accept = [];
	public function __construct($host="127.0.0.1",$port=9999){

		$this->server = stream_socket_server("tcp://".$host.":".$port,$errno,$errmsg);
		if(!$this->server){
			exit("{$errno}:{$errmsg}\n");
		}
		echo "服务器启动成功!\n";
		$this->read_arr[(int)$this->server] = $this->server;
		$this->run();
	}

	public function run(){
		// 接收消息
		echo "等待客户端连接\n";
		while(true){
			$events = $this->read_arr;
			$num = stream_select($events,$this->write_arr,$this->accept,null);
			if($num){
				foreach($events as $key=>$connection){
					// 接收请求
					if($connection == $this->server){
						$conn = stream_socket_accept($this->server);
						echo "接收远程客户端:",stream_socket_get_name($conn,true),"\n";
						// 将该套接字添加到监听数组中
						$this->read_arr[(int)$conn] = $conn;
					}else{
						// 有内容可读
						$msg = fread($connection,2048);
						echo "接收客户端消息:",$msg,"\n";
						// 解析内容
						$this->parseProtocol($msg,$class,$method,$parameters);
						// 执行对应的方法
						$this->execMethod($res,$class,$method,$parameters);
						// 返回给客户端消息
						$this->response($connection,$res);
						// 关闭客户端
						$this->close($connection);
						
					}
				}

			}
		}
	}

	protected function parseProtocol($msg,&$class,&$method,&$parameters){

		// 使用json传递
		$msg = json_decode($msg,true);
		$class = $msg['class'];
		$method = $msg['method'];
		$parameters = $msg['params'];
        }

	protected function execMethod(&$res,$class,$method,$params){
		// 如果传递进来的是类的某个方法
		$res = ['error'=>0,'data'=>''];
		if($class && $method){

			$class = ucfirst($class);
			// 加载对应的类文件
			$file = __DIR__.'/api/'.$class.'.php';
			if(!file_exists($file)){
				$res=['error'=>1,'data'=>'类不存在'];
				return;
			}
			require_once $file;
			try{
				$obj = new $class;
				// 执行对应的方法
				if($params){
					$res['data'] = $obj->$method($params);
				}else{
					$res['data'] = $obj->$method();
				}
			}catch(Exception $e){
				$res=['error'=>2000,'data'=>$e->getMessage()];
			}
		}else{
		// 只有方法名
			try{
				$res['data'] = call_user_func_array($method,$params);
			}catch(Exception $e){
				$res=['error'=>3000,'data'=>$e->getMessage()];
			}
		}
	}

	protected function response($client,$msg){
		// 封装成消息
		$msg = json_encode($msg,JSON_UNESCAPED_UNICODE);
		// 发送
		fwrite($client,$msg);
	}

	protected function close($client){
		// 从监听数组中删除该fd
		//fclose($client);
		unset($this->read_arr[(int)$client]);
		unset($this->write_arr[(int)$client]);
		fclose($client);
		echo "关闭了连接\n";
	}
}
