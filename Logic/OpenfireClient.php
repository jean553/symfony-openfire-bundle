<?php

namespace jean553\OpenfireBundle\Logic;

use GuzzleHttp\Client;

class OpenfireClient
{
    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * @var array
     *
     * Configuration with url and secret
     */
    private $config;

    /**
     * @param array $config 'url' and 'secret'
     */
    public function __construct($config)
    {
        $this->client = new Client();
        $this->config = $config;
    }

    /**
     * Execute a request according to the given type, url and parameters.
     *
     * @param string $type post, get, put, delete
     * @param string $action endpoint to call
     * @param array $params request parameters
     */
    public function request(
        $type, 
        $action, 
        $params
    ) {
        $headers = array(
            'Accept' => 'application/json',
            'Authorization' => $this->config['secret']
        );

        $body = json_encode($params);

        switch($type)
        {
            case 'post':
                $headers += ['Content-Type' => 'application/json'];

                $result = 
                    $this->client->post(
                        $this->config['url'].$action,
                        array(
                            'headers' => $headers,
                            'body' => $body
                        ) 
                    );
                break;
        }
    }
}
