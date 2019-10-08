<?php

class RpcClient{
	public static $rpcConfig = [
		"TestService"=>"http://127.0.0.1/yar/service.php",
	];
	public static function init($server){
		if(array_key_exists($server,self::$rpcConfig)){
			$uri = self::$rpcConfig[$server];
			return new Yar_client($uri);
		}
	}
}
$testService = RpcClient::init("TestService");
try{
$result = $testService->test("abcd");
echo $result;
}catch(Exception $e){
	
}
echo "<br>";
echo $testService->doAdd(10,20);
