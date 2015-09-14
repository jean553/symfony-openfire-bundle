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
     *
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Execute a request according to the given type, url and parameters.
     *
     * @param string $type post, get, put, delete
     * @param string $url endpoint to call
     * @param array $params request parameters
     */
    public function request(
        $type, 
        $url, 
        $params = array()
    ) {

        $body = json_encode($params);

        switch($type)
        {
            case 'post':
                $headers =+ ['Content-Type' => 'application/json'];

                $result = 
                    $this->client->post(
                        $url,
                        array(
                            'headers' => $headers,
                            'body' => $body
                        ) 
                    );
                break;
        }
    }
}
