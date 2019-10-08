<?php
require "vendor/autoload.php";

$client = new \JsonRpc\Client("http://127.0.0.1/jsonrpc/index.php");


$success = $client->call("divide",[42,6]);

echo $success;

echo $client->output;
