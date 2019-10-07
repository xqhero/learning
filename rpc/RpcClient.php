<?php
# rpc客户端
class RpcClient {
	
	private $urlInfo = [];
	public function __construct($url){
		$this->urlInfo = parse_url($url);
	}
	
	public function __call($name,$arguments){
		$client = stream_socket_client("tcp://{$this->urlInfo['host']}:{$this->urlInfo['port']}",$errno,$errstr);
		if(!$client){
			exit("{$errno} : {$errstr} \n");
		}

		$data = [
			'class' => basename($this->urlInfo['path']),
			'method'=>$name,
			'params'=>$arguments
		];

		fwrite($client,json_encode($data));
		
		$data = fread($client,2048);

		fclose($client);

		return $data;
	}
}

$cli = new RpcClient("http://127.0.0.1:9999/test");
echo $cli->run()."\n";
echo $cli->run2("123456")."\n";

