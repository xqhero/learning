<?php
include "hprose/Hprose.php";

use Hprose\Http\Client;

$client = new Client("http://127.0.0.1/hprose/index.php",false);
echo $client->hello("abcd");
