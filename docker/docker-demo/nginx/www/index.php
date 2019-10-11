<?php

$pdo = new PDO("mysql:host=db;charset=utf8;dbname=docker","root","root");


$redis = new Redis();
$redis->connect('redis',6379);

$redis->set("name","zhangsan");

echo $redis->get("name");
