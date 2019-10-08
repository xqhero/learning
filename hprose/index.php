<?php
require_once "hprose/Hprose.php";

use Hprose\Http\Server;
function hello($name){
	return "hello $name!";
}

$server = new Server();
$server->addFunction('hello');
$server->start();
