<?php
/**
 * Date: 12/14/15
 * Time: 1:47 PM
 */

require "RPCClient.php";

$rpcServer = 'http://rpc2.meiyaapp.cn';
$secretKey = 's3cr3t';

$client = new RPCClient($rpcServer, $secretKey);
$res = $client->execute('app', 'WXSendText', ['agentId'=>5, 'content'=>"hello world"]);

var_dump($res);
