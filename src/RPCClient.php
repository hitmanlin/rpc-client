<?php
/**
 * Date: 12/10/15
 * Time: 11:39 AM
 */

use JsonRPC\Client;

class RPCClient
{
    protected $secretKey;
    protected $client;

    public function __construct($rpcServer, $secretKey='')
    {
        $this->secretKey = $secretKey;
        $this->client = new Client($rpcServer);
    }

    public function execute($namespace, $method, $params=[])
    {
        $timestamp = time();
        $signature = $this->genSignature($namespace, $method, $timestamp);
        $res = $this->client->execute('call', [$namespace, $method, $params, $timestamp, $signature]);

        return $res;
    }

    public function genSignature($namespace, $method, $timestamp)
    {
        $str = $namespace . $method . $timestamp;
        $str = "{$this->secretKey}@{$str}@{$this->secretKey}";

        return md5($str);
    }
}
