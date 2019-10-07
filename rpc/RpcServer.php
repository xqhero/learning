<?php
namespace rpc;
#使用select模型
class RpcServer{

	private $server;
	private $read_arr = [];
	private $write_arr = [];
	private $accept = [];
	public function __construct($host=127.0.0.1,$port=9999){

		$this->server = stream_socket_server("tcp://".$host.":"$port,$errno,$errmsg);
		if(!$this->server){
			exit("{$errno}:{$errmsg}\n");
		}
		
		$this->read_arr[int($this->server)] = $this->server;
		$this->run();
	}

	public function run(){
		// 接收消息
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
						$this->read_arr[int($conn)] = $conn;
					}else{
						// 有内容可读
						$msg = fread($connection,2048);
						echo "接收客户端消息:",$msg,"\n";
						// 解析内容并进行处理
						$this->parseProtocol($msg,$class,$method,$parameters);
						// 执行对应的方法
						$this->exec()
					}
				}

			}
		}
	}

	protected function handleRpc($conn,$msg){

		// 匹配内容
		

        }



}
