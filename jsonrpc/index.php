<?php
require "vendor/autoload.php";

class ServerMethods
{
	public $error = null;
	public function divide($dividend,$divisor,$int=false){
	if(!$divisor){
		$this->error = "cannot divide by zero";
	}else{
		$quotient = $dividend / $divisor;
		return $int ? (int)$quotient : $quotient;
	}
    }

}

$methods = new ServerMethods();
$Server = new \JsonRpc\Server($methods);
$Server->receive();
