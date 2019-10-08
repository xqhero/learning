<?php

$client = new Yar_client("http://127.0.0.1/yar/service.php");
$result = $client->api("abcd");
echo $result;
echo "<br>";
echo $client->doAdd(10,20);
