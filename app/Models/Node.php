<?php

namespace App\Models;

use GuzzleHttp\Client;

class Node
{

    public function getNetworkInfo()
    {
        return $this->performRpcQuery('getnetworkinfo');
    }

    private function getApiEndpoint()
    {
        return 'http://188.93.155.14:8332';
    }

    private function performRpcQuery($method, $params = [])
    {
        // ie:
        // curl \
        // --user bitcoin \
        // --data-binary '{"jsonrpc": "1.0", "id":"curltest", "method": "getnetworkinfo", "params": [] }' \
        // -H 'content-type: text/plain;' \
        // http://10.0.1.5:8332/

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->getApiEndpoint(),
            // You can set any number of default request options.
            'timeout'  => 3,
        ]);

        // Guzzle automatically sets headers & json encode for us
        $options = [
            'json' => [
                'jsonrpc' => '1.0',
                'id' => 'curltest',
                'method' => $method,
                'params' => $params,
            ],
            'auth' => [
                'bitcoin',
                'redacted'
            ]
        ];

        $response = $client->post("/", $options);

        echo $response->getBody();
    }
}